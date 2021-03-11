<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Gallery;
use App\Http\Models\GalleryVideo;
use App\Http\Models\MediaImage;
use App\Http\Models\VideoGallery;
use Validator, DB, Image, File, Storage;

class GalleryVideoController extends Controller
{
    
    public function __construct() {
        parent::__construct();
        $this->viewData['page_title'] = 'Gallery Videos';
    }
    
    /*
     * @Date    : Nov 11, 2020
     * @Use     : Show menu listing
     * @Params  : -
     * @Cretaed By : Rajat Singh
     */
    public function index($galleryId=0) {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'All Videos';
        // 
        $gallery_id = base64_decode($galleryId);
        
        // Get Gallery Name
        $videoGalleryObj = new VideoGallery();
        $videoGalleryName = $videoGalleryObj->getName($gallery_id);
        $this->viewData['galleryId'] = $galleryId;
        $this->viewData['gallery_id'] = $gallery_id;
        $this->viewData['gallery_name'] = $videoGalleryName;
        
        // Get Gallery Videos
        $galleryVideo = new GalleryVideo();
        $arrGalleryVideoData = $galleryVideo->getDataWithPaginate($gallery_id);
        $allRecords = $arrGalleryVideoData['data'];
        $this->viewData['all_records'] = $allRecords;
        $this->viewData['no_records_found'] = config('constant.NO_RECORDS_FOUND');
        // print("<pre>"); print_r($allRecords); exit('controller');
        
        $this->viewData['allowfiletypetext'] = config('constant.ALLOW_FILE_TYPE_TEXT');
        $this->viewData['filetype'] = config('constant.File_TYPE');
        return view('video-gallery.category.index',$this->viewData);
    }

    public function add($video_gallery_id)
    {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'Add New Banner';
        // $this->viewData['id'] = $id;
        $this->viewData['allowfiletypetext'] = config('constant.ALLOW_FILE_TYPE_TEXT');
        $this->viewData['filetype'] = config('constant.File_TYPE');

        // $video_gallery_id = base64_decode($video_gallery_id);
        $this->viewData['video_gallery_id'] = $video_gallery_id;
        // Set Page Title
        $this->viewData['page_sub_title'] = 'Add New Video';
        $this->viewData['allowfiletypetext'] = config('constant.ALLOW_FILE_TYPE_TEXT');
        $this->viewData['filetype'] = config('constant.File_TYPE');
        
        // $this->viewData['banner_image'] = $banner->image;
        // $this->viewData['mobile_banner_image'] = $banner->mobile_image;
        // Social Type array
        $this->viewData['arr_status'] = config('constant.STATUS');
        // echo '<pre>'; print_r($this->viewData); exit;
        return view('video-gallery.category.add', $this->viewData);
    }
    
    public function store(Request $request, $video_gallery_id)
    {

        $input = $request->all();
        echo '<pre>'; print_r($input); exit('controller');
        // Validation => START
        // $validator = Validator::make($request->all(), [
        //     'banner_image' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
        // Validation => END
        // Initialize Variables
        $arrResp = [];
        $action = 'added';
        // Action
        $isUpdate = (isset($input['id']) && !empty($input['id'])) ? true : false;
        // New Menu Object
        $galleryVideoObj = new GalleryVideo();
        // Pass Data To Model
        if ($isUpdate) {
            // If Update True Pass Data To Model
            $galleryVideoObj->field['id'] = $input['id'];
            $action = 'updated';
        }
        else 
        {
            $galleryVideoObj->field['parent_id'] = $input['parent_id'];
        }
        $galleryVideoObj->field['title'] = $input['title'];
        $galleryVideoObj->field['thumbnail'] = $input['video_thumbnail'];
        $galleryVideoObj->field['video'] = $input['video_upload'];
        $galleryVideoObj->field['status'] = $input['status'];
        if ($isUpdate) {
            // If Update
            $arrResp = $galleryVideoObj->updateBanner();
        } else {
            // If Add
            $arrResp = $galleryVideoObj->addBanner();
        }

        if ($arrResp['status'] == 1) {
            // True
            Session::flash('message', "video has been $action sucessfully.");
            Session::flash('alert-class', 'alert-success');
            Session::flash('icon-class', 'icon fa fa-check');
            return redirect('admin/gallery-video');
        } else {
            // False
            Session::flash('message', 'Unabel to save video, please try again later!');
            Session::flash('alert-class', 'alert-danger');
            Session::flash('icon-class', 'icon fa fa-ban');
            return redirect('admin/gallery-video');
        }
    }

    /*
     * @Date    : Nov 11, 2020
     * @Use     : Upload New Video
     * @Params  : -
     * @Cretaed By : Rajat Singh
     */
    public function uploadThumb(Request $request) {
        
        $arrJson    = array();
        $status     = 0;
        $message    = '';
        $id = 0;
        $filenametostore = '';
        
        try {

            $input = $request->all();
            // echo '<pre>'; print_r($input); exit('here');
            // $roundId = base64_decode($input['round_id']);
            // $galleryId = base64_decode($input['gallery_id']);
            // $galleryId = base64_decode($galleryId);
            $galleryId = $input['gallery_id'];
            $group_type = $input['group_type'];

            $action = 'added';

            if(empty($galleryId)){
                throw new \Exception('Gallery id is missing, please try again!');
            }

            $validator = Validator::make($request->all(), [
                'file' => "required"
                // 'file' => "required|mimes:png,jpeg,jpg,gif|dimensions:width=1920,height=1280"
            ],[
                'file.required' => 'Select image',
                'file.mimes' => 'The file type must be a : png,jpeg,jpg,gif.',
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
                $pathOriginal = public_path().'/gallery/videos/thumbnail/' . $galleryId;
                if(!File::exists($pathOriginal)) {
                    // If Not Exist
                    File::makeDirectory($pathOriginal, $mode = 0777, true, true);
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
                $AWS_Upload_Path = $AWS_S3_UPLOAD_PATH.'gallery/videos/thumbnail/'.$galleryId.'/'.$filenametostore;
                // Storage::disk('s3')->put($AWS_Upload_Path, file_get_contents($file));
                // AWS S3 Image Upload => END


                // Original => START
                $destinationPath = public_path("gallery/videos/thumbnail/$galleryId/");
                $file->move($destinationPath, $filenametostore);
                // Original => END

                // 
                $mediaImage = new MediaImage();
                // Save Data
                $mediaImage->group_type = $group_type;
                $mediaImage->title = '';
                $mediaImage->image = $filenametostore;

                if($mediaImage->save()){
                    $id = $mediaImage->id;
                    $status = 1;
                    $message = "Video uploaded successfully.";
                } else {
                    throw new \Exception('Unable to upload Video, please try again!');
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

    /*
     * @Date    : Nov 11, 2020
     * @Use     : Upload New Video
     * @Params  : -
     * @Cretaed By : Rajat Singh
     */
    public function uploadVideo(Request $request) {
        
        $arrJson    = array();
        $status     = 0;
        $message    = '';
        $id = 0;
        $filenametostore = '';
        
        try {

            $input = $request->all();
            // echo '<pre>'; print_r($input); exit('here');
            // $roundId = base64_decode($input['round_id']);
            // $galleryId = base64_decode($input['gallery_id']);
            // $galleryId = base64_decode($galleryId);
            $galleryId = $input['gallery_id'];
            $group_type = $input['group_type'];

            $action = 'added';

            if(empty($galleryId)){
                throw new \Exception('Gallery id is missing, please try again!');
            }

            $validator = Validator::make($request->all(), [
                'file' => "required"
                // 'file' => "required|mimes:png,jpeg,jpg,gif|dimensions:width=1920,height=1280"
            ],[
                'file.required' => 'Select image',
                // 'file.mimes' => 'The file type must be a : mp4.',
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
                $pathOriginal = public_path().'/gallery/videos/original/' . $galleryId;
                if(!File::exists($pathOriginal)) {
                    // If Not Exist
                    File::makeDirectory($pathOriginal, $mode = 0777, true, true);
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
                $AWS_Upload_Path = $AWS_S3_UPLOAD_PATH.'gallery/videos/original/'.$galleryId.'/'.$filenametostore;
                // Storage::disk('s3')->put($AWS_Upload_Path, file_get_contents($file));
                // AWS S3 Image Upload => END


                // Original => START
                $destinationPath = public_path("gallery/videos/original/$galleryId/");
                $file->move($destinationPath, $filenametostore);
                // Original => END

                // 
                $mediaImage = new MediaImage();
                // Save Data
                $mediaImage->group_type = $group_type;
                $mediaImage->title = '';
                $mediaImage->image = $filenametostore;

                if($mediaImage->save()){
                    $id = $mediaImage->id;
                    $status = 1;
                    $message = "Video uploaded successfully.";
                } else {
                    throw new \Exception('Unable to upload Video, please try again!');
                }
                // $status = 1;
                // $message = "Video uploaded successfully.";

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

    public function getMediaImages(Request $request) {
        
        $input      = $request->all();
        $arrJson    = [];
        $status     = 0;
        $message    = '';
        $arrData    = [];
        try {
            //
            $loadCont  = $input['load_cont'];
            $group_type  = $input['groupType'];

            if($loadCont){
                // New Object
                $mediaImage = new MediaImage();
                $arrResp = $mediaImage->getAllImages($group_type);
                // print("<pre>"); print_r($arrResp); exit('controoler');
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
