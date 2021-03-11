<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use App\Http\Models\MediaImage;

use Storage, Validator, DB, Html, Form, Image;

class MediaController extends Controller
{
    
    public function __construct() {
        parent::__construct();
        $this->viewData['page_title'] = 'Media';
    }
    
    /*
     * @Date    : Feb 11, 2019
     * @Use     : Show menu listing
     * @Params  : -
     * @Cretaed By : SG
     */
    public function index() {
        // Set Slider Title
        $this->viewData['page_sub_title'] = 'All Media';
        // 
        
        $mediaImageObj = new MediaImage();
        $arrMediaImage = $mediaImageObj->getData();
        // print("<pre>"); print_r($arrMediaImage['data']); exit('sadas');
        $this->viewData['all_records'] = $arrMediaImage['data'];
        $this->viewData['no_records_found'] = config('constant.NO_RECORDS_FOUND');
        $this->viewData['allowfiletypetext'] = config('constant.ALLOW_FILE_TYPE_TEXT');
        $this->viewData['filetype'] = config('constant.File_TYPE');
        // print("<pre>"); print_r($this->viewData); exit('sadas');
        return view('media.index',$this->viewData);
    }
    
    public function uploadMediaImage(Request $request) {
        
        $arrJson    = array();
        $status     = 0;
        $message    = '';
        $id         = 0;
        $filenametostore = '';
        
        try {
            
            $input = $request->all();
            // echo '<pre>'; print_r($input); exit('here');
            $group_type  = (isset($input['group_type']) && !empty($input['group_type']) ? $input['group_type']:'media');
            // 
            $max_Size = 1000; // 1 MB
            $max_Size  = (isset($input['max_size']) && !empty($input['max_size']) ? $input['max_size']:1000);
            $action = 'added';
            if($group_type=='product-image'){
                // Validation => START
                $max_Size = 400;
            } else if($group_type=='pd-banner'){
                // Validation => START
                $max_Size = 500;
            } else if($group_type=='mob-banner'){
                // Validation => START
                $max_Size = 400;
            } else if($group_type=='home-slider'){
                // Validation => START
                $max_Size = 500;
            } else if($group_type=='social-update'){
                // Validation => START
                $max_Size = 150;
            } else if($group_type=='web-banner'){
                // Validation => START
                $max_Size = 400;
            }
            
            $validator = Validator::make($request->all(), [
                'file' => "required|mimes:png,jpeg,jpg,gif|max:$max_Size"
            ],[
                'file.required' => 'Select image',
                'file.mimes' => 'The file type must be a : png,jpeg,jpg,gif',
                'file.max' => "File size should not more than $max_Size kb."
            ]);
            //              
            if ($validator->fails()) {
                $error = $validator->errors()->first();
                // dd($error);
                // Throw New Exception
                throw new \Exception("$error");
            }
            
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                // foreach($request->file('images') as $file) {

                //get filename with extension
                $filenamewithextension = $file->getClientOriginalName();

                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                //get file extension
                $extension = $file->getClientOriginalExtension();

                //filename to store
                $filenametostore = str_replace(' ','_', $filename).'_'.uniqid().'.'.$extension;
                // echo $filenametostore; exit('here');

                // AWS S3 Image Upload => START
                $AWS_S3_UPLOAD_PATH = config('constant.AWS_S3_UPLOAD_PATH'); // File Upload Path
                // Original Image
                $AWS_Upload_Path = $AWS_S3_UPLOAD_PATH.'media-images/original/'.$filenametostore;
                // Storage::disk('s3')->put($AWS_Upload_Path, file_get_contents($file));
                // AWS S3 Image Upload => END
                // echo $filenametostore; exit('here');

                // Thumbnail => START
                $destinationPathThumb = public_path('uploads/media-images/thumbnail/');

                $img = Image::make($file->getRealPath());

                $img->resize(150, 150, function ($constraint) {

                            $constraint->aspectRatio();

                        })->save($destinationPathThumb.$filenametostore);
                // Thumbnail => END
                        
                // Medium Thumbnail 400 * 400 => START
                $destinationPathMedThumb = public_path('uploads/media-images/medium-thumbnail/');
                $img1 = Image::make($file->getRealPath());
                $img1->resize(400, 400, function ($constraint1) {
                    
                            $constraint1->aspectRatio();
                            
                        })->save($destinationPathMedThumb.$filenametostore);
                // Medium Thumbnail 400 * 400 => END

                // Original => START
                $destinationPath = public_path('uploads/media-images/original/');
                $file->move($destinationPath, $filenametostore);
                // Original => END

                // AWS S3 Image Upload => START
                // Thumbnail Image
                $thumnail_img_path = $destinationPathThumb.$filenametostore;
                $AWS_Thumb_Upload_Path = $AWS_S3_UPLOAD_PATH.'media-images/thumbnail/'.$filenametostore;
                // Storage::disk('s3')->put($AWS_Thumb_Upload_Path, file_get_contents($thumnail_img_path));
                // AWS S3 Image Upload => END
                // echo $filenametostore; exit('here');

                $mediaImage = new \App\Http\Models\MediaImage;
                $mediaImage->title = null;
                $mediaImage->group_type = $group_type;
                $mediaImage->image = $filenametostore;
                if($mediaImage->save()){
                    $id = $mediaImage->id;
                    
                    // Action Log => START
                    $actionLogObj = new \App\Http\Models\ActionLog();
                    $userData = Session::get('user_data');
                    $actionLogObj->field['record_id'] = $id; // Record ID
                    $actionLogObj->field['user_id'] = $userData['id'];
                    $actionLogObj->field['controller'] = 'media';
                    $actionLogObj->field['action'] = $action;
                    $actionLogObj->addLog();
                    // Action Log => END
                    
                    $status = 1;
                    $message = "Image uploaded successfully.";
                } else {
                    throw new \Exception('Unable to upload image, please try again!');
                }
                //}
            } else {
                // Throw New Exception
                throw new \Exception('Missing params, please try again!');
            }
            
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
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
                $mediaImage = new MediaImage();
                $arrRow = $mediaImage->select('image')->where('id', '=', $imgId)->first();
                if(!empty($arrRow)){
                    // print("<pre>"); print_r($arrRow); exit;
                    // Get image
                    $image = $arrRow->image;
                    // unlink image
                    if(file_exists(public_path("uploads/media-images/thumbnail/$image"))){
                        unlink(public_path("uploads/media-images/thumbnail/$image"));
                    }
                    if(file_exists(public_path("uploads/media-images/original/$image"))){
                        unlink(public_path("uploads/media-images/original/$image"));
                    }
                    
                    // AWS S3 UPLOAD PATH
                    $AWS_S3_UPLOAD_PATH = config('constant.AWS_S3_UPLOAD_PATH'); // File Upload Path
                    
                    $AWS_Thumb_Upload_Path_Thumb = $AWS_S3_UPLOAD_PATH.'media-images/thumbnail/'.$image;
                    // Storage::disk('s3')->delete($AWS_Thumb_Upload_Path_Thumb);
                    
                    $AWS_Thumb_Upload_Path_Original = $AWS_S3_UPLOAD_PATH.'media-images/original/'.$image;
                    // Storage::disk('s3')->delete($AWS_Thumb_Upload_Path_Original);
                    
                    // Pass Data To Model
                    $mediaImage->field['id'] = $imgId;
                    $arrResp = $mediaImage->deleteImage();
                    // print_r($arrResp); exit('sadsa');
                    if($arrResp['status']==1){
                        // Action Log => START
                        $action = 'deleted';
                        $actionLogObj = new \App\Http\Models\ActionLog();
                        $userData = Session::get('user_data');
                        $actionLogObj->field['record_id'] = $imgId; // Record ID
                        $actionLogObj->field['user_id'] = $userData['id'];
                        $actionLogObj->field['controller'] = 'media';
                        $actionLogObj->field['action'] = $action;
                        $actionLogObj->addLog();
                        // Action Log => END
                        $status = 1;
                        $message = "Media has been deleted sucessfully";
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
    
    public function getMediaImages(Request $request) {
        
        $input      = $request->all();
        $arrJson    = [];
        $status     = 0;
        $message    = '';
        $arrData    = [];
        try {
            //
            $loadCont  = $input['load_cont'];
            $group_type  = (isset($input['group_type']) && !empty($input['group_type']) ? $input['group_type']:'media');
            if($loadCont){
                // New Object
                $mediaImage = new MediaImage();
                $arrResp = $mediaImage->getAllImages($group_type);
                /// print("<pre>"); print_r($arrResp); exit;
                if($arrResp['status']==1){
                    if(!empty($arrResp['data'])){
                        foreach ($arrResp['data'] as $key => $value) {
                            $arrData[] = [
                                        'id' => $value->id,
                                        'title' => $value->title,
                                        'image' => $value->image,
                                        'created_at' => $value->created_at,
                                    ];
                        }
                    }
                    $status = 1;
                    $message = $arrResp['message'];
                }else{
                    throw new \Exception('Unable to get media images, please try again later!');
                }
            }  else {
                // Throw New Exception
                throw new \Exception('Missing params, please try again!');
            }
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        
        $arrJson['status']  = $status;
        $arrJson['message'] = $message;
        $arrJson['data']    = $arrData;
        
        echo json_encode($arrJson); exit;
        
    }
    
}
