<?php

namespace App\Http\Controllers\Slider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Slider;
use App\Http\Models\SliderImage;
use Validator, DB, Image, File, Storage;


class SliderImagesController extends Controller
{
    
    public function __construct() {
        parent::__construct();
        $this->viewData['page_title'] = 'Slider Image';
    }
    
    /*
     * @Date    : Feb 11, 2019
     * @Use     : Show menu listing
     * @Params  : -
     * @Cretaed By : SG
     */
    public function index($sliderId=0) {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'Slider Image';
        // 
        $sliderId = base64_decode($sliderId);
        // Slider
        $slider = new Slider();
        $sliderName = $slider->getName($sliderId);
        $this->viewData['slider_id'] = $sliderId;
        $this->viewData['slider_name'] = $sliderName;
        
        $sliderImage = new SliderImage();
        $arrSliderImagesData = $sliderImage->getData($sliderId);
        $allRecords = $arrSliderImagesData['data'];
        $this->viewData['all_records'] = $allRecords;
        $this->viewData['no_records_found'] = config('constant.NO_RECORDS_FOUND');
        
        // print("<pre>"); print_r($this->viewData['all_records']); exit('sadas');
        $this->viewData['allowfiletypetext'] = config('constant.ALLOW_FILE_TYPE_TEXT');
        $this->viewData['filetype'] = config('constant.File_TYPE');
        return view('slider.slider-images.index',$this->viewData);
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
            $sliderId = base64_decode($input['slider_id']);
            $action = 'added';
              
            if(empty($sliderId)){
                throw new \Exception('Slider id is missing, please try again!');
            }
            
            $validator = Validator::make($request->all(), [
                'file' => "required|mimes:png,jpeg,jpg,gif|dimensions:width=1920,height=1080"
            ],[
                'file.required' => 'Select image',
                'file.mimes' => 'The file type must be a : png, jpeg, jpg, gif.',
                'file.dimensions' => 'Image has invalid dimensions',
            ]);
            
            if ($validator->fails()) {
                $error = $validator->errors()->first(); 
                // dd($error);
                // Throw New Exception
                throw new \Exception("$error");
            }
            
            if ($request->hasFile('file')) {
                // Create Directories
                $pathOriginal = public_path().'/uploads/slider-images/original/' . $sliderId;
                if(!File::exists($pathOriginal)) {
                    // If Not Exist
                    File::makeDirectory($pathOriginal, $mode = 0777, true, true);
                }
                $pathThumbnail = public_path().'/uploads/slider-images/thumbnail/' . $sliderId;
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
                    $AWS_Upload_Path = $AWS_S3_UPLOAD_PATH.'slider-images/original/'.$sliderId.'/'.$filenametostore;
                    // Storage::disk('s3')->put($AWS_Upload_Path, file_get_contents($file));
                    // AWS S3 Image Upload => END
                    
                    // Thumbnail => START
                    $destinationPathThumb = public_path("uploads/slider-images/thumbnail/$sliderId/");
                    
                    $img = Image::make($file->getRealPath());
                    
                    $img->resize(300, 300, function ($constraint) {

                        $constraint->aspectRatio();
                        
                    })->save($destinationPathThumb.'/'.$filenametostore);
                    // Thumbnail => END
                           
                    // Original => START
                    $destinationPath = public_path("uploads/slider-images/original/$sliderId/");
                    $file->move($destinationPath, $filenametostore);
                    // Original => END
                    
                    // AWS S3 Image Upload => START
                    // Thumbnail Image
                    $thumnail_img_path = $destinationPathThumb.$filenametostore;
                    $AWS_Thumb_Upload_Path = $AWS_S3_UPLOAD_PATH.'slider-images/thumbnail/'.$sliderId.'/'.$filenametostore;
                    // Storage::disk('s3')->put($AWS_Thumb_Upload_Path, file_get_contents($thumnail_img_path));
                    // AWS S3 Image Upload => END
                    
                    // 
                    $sliderImage = new SliderImage();
                    // Save Data
                    $sliderImage->slider_id = $sliderId;
                    $sliderImage->image = $filenametostore;
                    
                    if($sliderImage->save()){
                        $id = $sliderImage->id;
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
                        $actionLogObj->field['controller'] = 'slider-images';
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
                $sliderImage = new SliderImage();
                $arrRow = $sliderImage->select('slider_id','image')->where('id', '=', $imgId)->first();
                if(!empty($arrRow)){
                    // Get image
                    $image = $arrRow->image;
                    $slider_id = $arrRow->slider_id;
                    // unlink image
                    if(file_exists(public_path("uploads/slider-images/thumbnail/$slider_id/$image"))){
                        unlink(public_path("uploads/slider-images/thumbnail/$slider_id/$image"));
                    }
                    if(file_exists(public_path("uploads/slider-images/original/$slider_id/$image"))){
                        unlink(public_path("uploads/slider-images/original/$slider_id/$image"));
                    }
                    
                    // AWS S3 UPLOAD PATH
                    $AWS_S3_UPLOAD_PATH = config('constant.AWS_S3_UPLOAD_PATH'); // File Upload Path
                    
                    $AWS_Thumb_Upload_Path_Thumb = $AWS_S3_UPLOAD_PATH.'slider-images/thumbnail/'.$slider_id.'/'.$image;
                    // Storage::disk('s3')->delete($AWS_Thumb_Upload_Path_Thumb);
                    
                    $AWS_Thumb_Upload_Path_Original = $AWS_S3_UPLOAD_PATH.'slider-images/original/'.$slider_id.'/'.$image;
                    // Storage::disk('s3')->delete($AWS_Thumb_Upload_Path_Original);
                    
                    // Pass Data To Model
                    $sliderImage->field['id'] = $imgId;
                    $arrResp = $sliderImage->deleteSlide();
                    // print_r($arrResp); exit('sadsa');
                    if($arrResp['status']==1){  
                        // Action Log => START
                        $action = 'deleted';
                        $actionLogObj = new \App\Http\Models\ActionLog();
                        $userData = Session::get('user_data');
                        $actionLogObj->field['record_id'] = $imgId; // Record ID
                        $actionLogObj->field['user_id'] = $userData['id'];
                        $actionLogObj->field['controller'] = 'slider-images';
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
