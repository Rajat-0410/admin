<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Gallery;
use App\Http\Models\VideoGallery;
use Storage, Validator, DB, Html, Form, Image;

class GalleryController extends Controller
{
    
    public function __construct() {
        parent::__construct();
        $this->viewData['page_title'] = 'Gallery';
    }
    
    /*
     * @Date    : Nov 11, 2020
     * @Use     : Show Gallery listing
     * @Params  : -
     * @Cretaed By : Rajat Singh
     */
    public function index() {
        // Set Gallery Title
        $this->viewData['page_sub_title'] = 'All Image Gallery';
        // 
        $galleryObj = new Gallery();
        $arrGalleryData = $galleryObj->getDataWithPaginate();
        $this->viewData['all_records'] = $arrGalleryData['data'];
        $this->viewData['no_records_found'] = config('constant.NO_RECORDS_FOUND');
        // print("<pre>"); print_r($arrGalleryData); exit('controller');
        return view('gallery.index',$this->viewData);
    }

    /*
     * @Date    : Nov 11, 2020
     * @Use     : Show Video Gallery listing
     * @Params  : -
     * @Cretaed By : Rajat Singh
     */
    public function videoIndex() {
        // Set Gallery Title
        $this->viewData['page_sub_title'] = 'All Video Gallery';
        // 
        $videoGalleryObj = new VideoGallery();
        $arrVideoGalleryData = $videoGalleryObj->getDataWithPaginate();
        $this->viewData['all_records'] = $arrVideoGalleryData['data'];
        $this->viewData['no_records_found'] = config('constant.NO_RECORDS_FOUND');
        // print("<pre>"); print_r($arrVideoGalleryData); exit('controller');
        return view('video-gallery.index',$this->viewData);
    }
    
    /*
     * @Date    : Nov 11, 2020
     * @Use     : Add Gallery
     * @Params  : -
     * @Cretaed By : Rajat Singh
     */
    public function add() {
        // Set TournamentGallery Title
        $this->viewData['page_sub_title'] = 'Add New Gallery';
        
        $this->viewData['arr_status'] = config('constant.STATUS');
        $this->viewData['allowfiletypetext'] = config('constant.ALLOW_FILE_TYPE_TEXT');
        $this->viewData['filetype'] = config('constant.File_TYPE');
           
        return view('tournament-gallery.add',$this->viewData);
    }
    
    /*
     * @Date    : Nov 11, 2020
     * @Use     : Edit Gallery
     * @Params  : -
     * @Cretaed By : Rajat Singh
     */
    public function edit($id) {
        // Set Gallery Title
        $this->viewData['page_sub_title'] = 'Edit Gallery';
        $id = base64_decode($id);
        $gallery = Gallery::find($id);
        $this->viewData['id'] = $gallery->id;
        $this->viewData['name'] = $gallery->name;
        $this->viewData['slug'] = $gallery->slug;
        $this->viewData['featured_image'] = $gallery->featured_image;
        $this->viewData['status'] = $gallery->status;
        $this->viewData['arr_status'] = config('constant.STATUS');
        $this->viewData['allowfiletypetext'] = config('constant.ALLOW_FILE_TYPE_TEXT');
        $this->viewData['filetype'] = config('constant.File_TYPE');
                
        return view('gallery.edit',$this->viewData);
    }
    
    public function store(Request $request) {
        
        try {
            
            $input = $request->all();
            // echo '<pre>'; print_r($input); exit;
            
            // Validation => START
            $validator = Validator::make($request->all(), [
                'name' => 'required'
            ],[
                'name.required' => 'Please enter name'
            ]);
            if ($validator->fails()) {
                // $errors = $validator->errors();
                return redirect()->back()->withErrors($validator)->withInput();
            }
            // Validation => END
            
            // Initialize Variables
            $arrResp = [];
            $action = 'added';
            // Action
            $isUpdate = (isset($input['id']) && !empty($input['id'])) ? true:false;
            // New Menu Object
            $gallery = new Gallery();
            // Pass Data To Model
            if($isUpdate){
                // If Update True Pass Data To Model
                $gallery->field['id'] = $input['id'];
                $gallery->field['slug'] = $input['slug'];
                $action = 'updated';
            }
            $gallery->field['name'] = $input['name'];
            $gallery->field['featured_image'] = $input['featured_image'];
            $gallery->field['status'] = $input['status'];

            // Slug Creation => START | This should be here
            $arrResp = $gallery->createSlug();
            // echo '<pre>'; print_r($arrResp); exit;
            $str_slug = '';
            if($arrResp['status']==0){
                throw new \Exception($arrResp['message']);
            } else {
                $str_slug = $arrResp['str_slug'];
            }
            $gallery->field['slug'] = $str_slug;
            // Slug Creation => END

            if($isUpdate){
                // If Update
                $arrResp = $gallery->updateGallery();
            } else {
                // If Add
                $arrResp = $gallery->addGallery();
            }

            if($arrResp['status']==1){
                $id = $arrResp['row_id'];
                // True
                Session::flash('message', "Gallery has been $action sucessfully."); 
                Session::flash('alert-class', 'alert-success'); 
                Session::flash('icon-class', 'icon fa fa-check');
            } else {
                // Throw New Exception
                throw new \Exception('Unabel to save slider, please try again later!');
            }
            
        } catch (\Exception $ex) {
            Session::flash('message', $ex->getMessage()); 
            Session::flash('alert-class', 'alert-danger'); 
            Session::flash('icon-class', 'icon fa fa-ban');
        }
        return redirect('admin/gallery');
                
    }
    
    public function delete($id) {
        
        $arrResp = [];
        // New Menu Object
        $gallery = new Gallery();
        // Pass Data To Model
        $gallery->field['id'] = base64_decode($id);
        $arrResp = $gallery->deleteGallery();
        // print_r($arrResp); exit('sadsa');
        if($arrResp['status']==1){
            // True
            Session::flash('message', "Gallery has been deleted sucessfully."); 
            Session::flash('alert-class', 'alert-success'); 
            Session::flash('icon-class', 'icon fa fa-check');
            return redirect('admin/gallery');
        } else {
            // False
            Session::flash('message', 'Unabel to delete page, please try again later!'); 
            Session::flash('alert-class', 'alert-danger'); 
            Session::flash('icon-class', 'icon fa fa-ban');
            return redirect('admin/gallery');
        }
        
    }
    
}
