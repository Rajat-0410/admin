<?php

namespace App\Http\Controllers\Slider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Slider;
use App\Http\Models\SliderImage;
use Storage, Validator, DB, Html, Form, Image;

class SliderController extends Controller
{
    
    public function __construct() {
        parent::__construct();
        $this->viewData['page_title'] = 'Sliders';
    }
    
    /*
     * @Date    : Feb 11, 2019
     * @Use     : Show menu listing
     * @Params  : -
     * @Cretaed By : SG
     */
    public function index() {
        // Set Slider Title
        $this->viewData['page_sub_title'] = 'All Sliders';
        // 
        $paginate = 10;
        $allRecords = DB::table('sliders')
                        ->select('sliders.id','sliders.name','sliders.slug','sliders.status','sliders.created_at')
                        ->where('sliders.is_deleted','=',0)
                        ->orderBy('sliders.created_at', 'desc')
                        ->paginate($paginate);
        
        $this->viewData['all_records'] = $allRecords;
        $this->viewData['no_records_found'] = config('constant.NO_RECORDS_FOUND');
        // print("<pre>"); print_r($this->viewData); exit('sadas');
        return view('slider.index',$this->viewData);
    }
    
    /*
     * @Date    : Feb 11, 2019
     * @Use     : Add New Menu
     * @Params  : -
     * @Cretaed By : SG
     */
    public function add() {
        // Set Slider Title
        $this->viewData['page_sub_title'] = 'Add New Slider';
        
        $this->viewData['arr_status'] = config('constant.STATUS');
        $this->viewData['allowfiletypetext'] = config('constant.ALLOW_FILE_TYPE_TEXT');
        $this->viewData['filetype'] = config('constant.File_TYPE');
           
        return view('slider.add',$this->viewData);
    }
    
    /*
     * @Date    : Feb 11, 2019
     * @Use     : Add New Menu
     * @Params  : -
     * @Cretaed By : SG
     */
    public function edit($id) {
        // Set Slider Title
        $this->viewData['page_sub_title'] = 'Edit Slider';
        $id = base64_decode($id);
        $slider = Slider::find($id);
        $this->viewData['id'] = $slider->id;
        $this->viewData['name'] = $slider->name;
        $this->viewData['slug'] = $slider->slug;
        $this->viewData['status'] = $slider->status;
        $this->viewData['arr_status'] = config('constant.STATUS');
        $this->viewData['allowfiletypetext'] = config('constant.ALLOW_FILE_TYPE_TEXT');
        $this->viewData['filetype'] = config('constant.File_TYPE');
                
        return view('slider.edit',$this->viewData);
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
            $slider = new Slider();
            // Pass Data To Model
            if($isUpdate){
                // If Update True Pass Data To Model
                $slider->field['id'] = $input['id'];
                $slider->field['slug'] = $input['slug'];
                $action = 'updated';
            }
            $slider->field['name']     = $input['name'];
            $slider->field['status']   = $input['status'];

            // Slug Creation => START | This should be here
            $arrResp = $slider->createSlug();
            // echo '<pre>'; print_r($arrResp); exit;
            $str_slug = '';
            if($arrResp['status']==0){
                throw new \Exception($arrResp['message']);
            } else {
                $str_slug = $arrResp['str_slug'];
            }
            $slider->field['slug'] = $str_slug;
            // Slug Creation => END

            if($isUpdate){
                // If Update
                $arrResp = $slider->updateSlider();
            } else {
                // If Add
                $arrResp = $slider->addSlider();
            }

            if($arrResp['status']==1){
                $id = $arrResp['row_id'];
                // True
                Session::flash('message', "Slider has been $action sucessfully."); 
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
        return redirect('admin/slider');
                
    }
    
    public function delete($id) {
        
        $arrResp = [];
        // New Menu Object
        $slider = new Slider();
        // Pass Data To Model
        $slider->field['id'] = base64_decode($id);
        $arrResp = $slider->deleteSlider();
        // print_r($arrResp); exit('sadsa');
        if($arrResp['status']==1){
            // True
            Session::flash('message', "Slider has been deleted sucessfully."); 
            Session::flash('alert-class', 'alert-success'); 
            Session::flash('icon-class', 'icon fa fa-check');
            return redirect('admin/slider');
        } else {
            // False
            Session::flash('message', 'Unabel to delete page, please try again later!'); 
            Session::flash('alert-class', 'alert-danger'); 
            Session::flash('icon-class', 'icon fa fa-ban');
            return redirect('admin/slider');
        }
        
    }
    
}
