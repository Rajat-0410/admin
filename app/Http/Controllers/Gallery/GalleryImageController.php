<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Gallery;
use App\Http\Models\Round;
use App\Http\Models\GalleryImage;
use Validator, DB, Image, File, Storage;


class GalleryImageController extends Controller
{
    
    public function __construct() {
        parent::__construct();
        $this->viewData['page_title'] = 'Gallery Images';
    }
    
    /*
     * @Date    : Nov 11, 2020
     * @Use     : Show Gallery Images listing
     * @Params  : -
     * @Cretaed By : Rajat Singh
     */
    public function index($galleryId=0) {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'Gallery Images';
        // 
        $gallery_id = base64_decode($galleryId);
        
        // Get Gallery Name
        $galleryObj = new Gallery();
        $gallerName = $galleryObj->getName($gallery_id);
        $this->viewData['galleryId'] = $galleryId;
        $this->viewData['gallery_id'] = $gallery_id;
        $this->viewData['gallery_name'] = $gallerName;
        
        $galleryImage = new GalleryImage();
        $arrGalleryImageData = $galleryImage->getDataWithPaginate($gallery_id);
        $allRecords = $arrGalleryImageData['data'];
        $this->viewData['all_records'] = $allRecords;
        $this->viewData['no_records_found'] = config('constant.NO_RECORDS_FOUND');
        // print("<pre>"); print_r($allRecords); exit('contorleer');
        
        $this->viewData['allowfiletypetext'] = config('constant.ALLOW_FILE_TYPE_TEXT');
        $this->viewData['filetype'] = config('constant.File_TYPE');
        return view('gallery.gallery-image.index',$this->viewData);
    }
    
    public function uploadImage(Request $request) {
        
        $arrJson    = array();
        $status     = 0;
        $message    = '';
        $id = 0;
        $filenametostore = '';
        
        try {

            $input = $request->all();
            // echo '<pre>'; print_r($input); exit('here');
            // $roundId = base64_decode($input['round_id']);
            $galleryId = base64_decode($input['gallery_id']);
            $galleryId = base64_decode($galleryId);

            $action = 'added';

            if(empty($galleryId)){
                throw new \Exception('Gallery id is missing, please try again!');
            }

            $validator = Validator::make($request->all(), [
                'file' => "required|mimes:png,jpeg,jpg,gif"
                // 'file' => "required|mimes:png,jpeg,jpg,gif|dimensions:width=1920,height=1280"
            ],[
                'file.required' => 'Select image',
                'file.mimes' => 'The file type must be a : png, jpeg, jpg, gif.',
                // 'file.dimensions' => 'Image has invalid dimensions',
            ]);
            
            if ($validator->fails()) {
                $error = $validator->errors()->first(); 
                // dd($error);
                // Throw New Exception
                throw new \Exception("$error");
            }
            
            if ($request->hasFile('file')) {
                
                // Create Directories
                $pathOriginal = public_path().'/gallery/images/original/' . $galleryId;
                if(!File::exists($pathOriginal)) {
                    // If Not Exist
                    File::makeDirectory($pathOriginal, $mode = 0777, true, true);
                }
                $pathThumbnail = public_path().'/gallery/images/thumbnail/' . $galleryId;
                if(!File::exists($pathThumbnail)) {
                    // If Not Exist
                    File::makeDirectory($pathThumbnail, $mode = 0777, true, true);
                }

                $file = $request->file('file');
                // echo '<pre>'; print_r($file); exit('sas');
                // foreach($request->file('images') as $file) {

                //get filename with extension
                $filenamewithextension = $file->getClientOriginalName();

                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                //get file extension
                $extension = $file->getClientOriginalExtension();

                //filename to store
                // $filenametostore = $filenamewithextension;
                $filenametostore = $filename.'_'.uniqid().'.'.$extension;

                // AWS S3 Image Upload => START
                $AWS_S3_UPLOAD_PATH = config('constant.AWS_S3_UPLOAD_PATH'); // File Upload Path
                // Original Image
                $AWS_Upload_Path = $AWS_S3_UPLOAD_PATH.'gallery/images/original/'.$galleryId.'/'.$filenametostore;
                // Storage::disk('s3')->put($AWS_Upload_Path, file_get_contents($file));
                // AWS S3 Image Upload => END

                // Thumbnail => START
                $destinationPathThumb = public_path("gallery/images/thumbnail/$galleryId/");

                $img = Image::make($file->getRealPath());
                
                // $img->fit(420, 279, function ($constraint) {
                $img->fit(360, 239, function ($constraint) {
                    
                    $constraint->upsize();

                })->save($destinationPathThumb.'/'.$filenametostore);
                // Thumbnail => END

                // Original => START
                $destinationPath = public_path("gallery/images/original/$galleryId/");
                $file->move($destinationPath, $filenametostore);
                // Original => END

                // AWS S3 Image Upload => START
                // Thumbnail Image
                $thumnail_img_path = $destinationPathThumb.$filenametostore;
                $AWS_Thumb_Upload_Path = $AWS_S3_UPLOAD_PATH.'gallery/images/thumbnail/'.$galleryId.'/'.$filenametostore;
                // Storage::disk('s3')->put($AWS_Thumb_Upload_Path, file_get_contents($thumnail_img_path));
                // AWS S3 Image Upload => END

                // 
                $galleryImage = new GalleryImage();
                // Save Data
                $galleryImage->gallery_id = $galleryId;
                $galleryImage->image = $filenametostore;

                if($galleryImage->save()){
                    $id = $galleryImage->id;
                    $status = 1;
                    $message = "Image uploaded successfully.";
                } else {
                    throw new \Exception('Unable to upload image, please try again!');
                }

                if(!empty($id)){
                    // Action Log => START
                    $actionLogObj = new \App\Http\Models\ActionLog();
                    $userData = Session::get('user_data');
                    $actionLogObj->field['record_id'] = $id; // Record ID
                    $actionLogObj->field['user_id'] = $userData['id'];
                    $actionLogObj->field['controller'] = 'gallery-image';
                    $actionLogObj->field['action'] = $action;
                    $actionLogObj->addLog();
                    // Action Log => END
                }

            // }
            } else {
                // Throw New Exception
                throw new \Exception('Missing params, please try again!');
            }
            
        } catch (\Exception $ex) {
            $status = 0;
            echo 'exception';
            echo $message = $ex->getMessage();
        }
        
        $arrJson['status']  = $status;
        $arrJson['message'] = $message;
        $arrJson['data']  = ['id' => $id, 'image' => $filenametostore];
        
        echo json_encode($arrJson); exit;
        
    }
        
    public function delete(Request $request) {
        
        $input      = $request->all();
        $arrJson    = array();
        $status     = 0;
        $message    = '';
        try {
            // 
            $imgId  = $input['img_id'];
            if(!empty($imgId)){
                // echo '<pre>'; print($imgId); exit('here');
                // New Object
                $galleryImage = new GalleryImage();
                $arrRow = $galleryImage->select('gallery_id','image')->where('id', '=', $imgId)->first();
                if(!empty($arrRow)){
                    // Get image
                    $image = $arrRow->image;
                    $gallery_id = $arrRow->gallery_id;
                    // unlink image
                    if(file_exists(public_path("gallery/images/thumbnail/$gallery_id/$image"))){
                        unlink(public_path("gallery/images/thumbnail/$gallery_id/$image"));
                    }
                    if(file_exists(public_path("gallery/images/original/$gallery_id/$image"))){
                        unlink(public_path("gallery/images/original/$gallery_id/$image"));
                    }
                    
                    // AWS S3 UPLOAD PATH
                    $AWS_S3_UPLOAD_PATH = config('constant.AWS_S3_UPLOAD_PATH'); // File Upload Path
                    
                    $AWS_Thumb_Upload_Path_Thumb = $AWS_S3_UPLOAD_PATH.'gallery/images/thumbnail/'.$gallery_id.'/'.$image;
                    // Storage::disk('s3')->delete($AWS_Thumb_Upload_Path_Thumb);
                    
                    $AWS_Thumb_Upload_Path_Original = $AWS_S3_UPLOAD_PATH.'gallery/images/original/'.$gallery_id.'/'.$image;
                    // Storage::disk('s3')->delete($AWS_Thumb_Upload_Path_Original);
                    
                    // Pass Data To Model
                    $galleryImage->field['id'] = $imgId;
                    $arrResp = $galleryImage->deleteImage();
                    // print_r($arrResp); exit('sadsa');
                    if($arrResp['status']==1){ 
                        // Action Log => START
                        $action = 'deleted';
                        $actionLogObj = new \App\Http\Models\ActionLog();
                        $userData = Session::get('user_data');
                        $actionLogObj->field['record_id'] = $imgId; // Record ID
                        $actionLogObj->field['user_id'] = $userData['id'];
                        $actionLogObj->field['controller'] = 'tournament-gallery-image';
                        $actionLogObj->field['action'] = $action;
                        $actionLogObj->addLog();
                        // Action Log => END
                        $status = 1;
                        $message = "Image has been deleted sucessfully";
                    }else{
                        throw new \Exception('Unabel to delete image, please try again later!');
                    }
                } else {
                    // Throw New Exception
                    throw new \Exception('Image does not exist, please try again!');
                }
                
            }  else {
                // Throw New Exception
                throw new \Exception('Missing params, please try again!');
            }
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        
        $arrJson['status'] = $status;
        $arrJson['message'] = $message;
        
        echo json_encode($arrJson); exit;
    }
}
