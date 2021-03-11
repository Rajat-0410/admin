<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Page;
use Validator, DB;


class PageController extends Controller
{
    
    public function __construct() {
        parent::__construct();
        $this->viewData['page_title'] = 'Pages';
    }
    
    /*
     * @Date    : Feb 11, 2019
     * @Use     : Show menu listing
     * @Params  : -
     * @Cretaed By : SG
     */
    public function index(Request $request) {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'All Pages';
        // 
        $input = $request->all();
        $paginate = config('constant.PAGINATE');
        $keyword = '';
        $page = new Page; 
        if(!empty($input['keyword'])){
            // echo '<pre>'; print_r($input); exit;
            $keyword = $input['keyword'];
            $page->where('pages.title','like',$keyword);
        }
        $allData = $page->getDataWithPaginate($paginate,$keyword);
        $allRecords = $allData['data'];
        // print("<pre>"); print_r($allRecords); exit('here');        
        $this->viewData['keyword'] = $keyword;
        $this->viewData['all_records'] = $allRecords;
        $this->viewData['no_records_found'] = config('constant.NO_RECORDS_FOUND');
        // print("<pre>"); print_r($this->viewData); exit('sadas');
        return view('page.index',$this->viewData);
    }
    
    /*
     * @Date    : Feb 11, 2019
     * @Use     : Add New Menu
     * @Params  : -
     * @Cretaed By : SG
     */
    public function add() {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'Add New Page';
        
        $this->viewData['arr_status'] = config('constant.STATUS');
           
        return view('page.add',$this->viewData);
    }
    
    /*
     * @Date    : Feb 11, 2019
     * @Use     : Add New Menu
     * @Params  : -
     * @Cretaed By : SG
     */
    public function edit($id) {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'Edit Page';
        $page = Page::find(base64_decode($id));
        $this->viewData['id'] = $page->id;
        $this->viewData['title'] = $page->title;
        $this->viewData['slug'] = $page->slug;
        $this->viewData['page_id'] = $page->page_id;
        $this->viewData['content'] = $page->content;
        $this->viewData['meta_title'] = $page->meta_title;
        $this->viewData['meta_description'] = $page->meta_description;
        $this->viewData['meta_keywords'] = $page->meta_keywords;
        $this->viewData['status'] = $page->status;
        // echo '<pre>'; print_r($this->viewData); exit;
        
        $this->viewData['arr_status'] = config('constant.STATUS');
        
        return view('page.edit',$this->viewData);
    }
    
    public function store(Request $request) {
        
        $input = $request->all();
        // Action
        $isUpdate = (isset($input['id']) && !empty($input['id'])) ? true:false;
        // echo '<pre>'; print_r($input); exit;
        // Validation => START
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Validation => END
        // Initialize Variables
        $arrResp = [];
        $action = 'added';
        // New Menu Object
        $page = new Page();
        // Pass Data To Model
        if($isUpdate){
            // If Update True Pass Data To Model
            $page->field['id'] = $input['id'];
            $page->field['slug'] = $input['slug'];
            $action = 'updated';
        }
        $page->field['title']       = $input['title'];
        $page->field['content']     = $input['content'];
        $page->field['meta_title']  = $input['meta_title'];
        $page->field['meta_description'] = $input['meta_description'];
        $page->field['meta_keywords'] = $input['meta_keywords'];
        $page->field['status'] = $input['status'];
        
         // Slug Creation => START | This should be here
        $arrResp = $page->createSlug();
        // echo '<pre>'; print_r($arrResp); exit;
        $str_slug = '';
        if($arrResp['status']==0){
            throw new \Exception($arrResp['message']);
        } else {
            $str_slug = $arrResp['str_slug'];
        }
        $page->field['slug'] = $str_slug;
        // Slug Creation => END
        
        if($isUpdate){
            // If Update
            $arrResp = $page->updatePage();
        } else {
            // If Add
            $arrResp = $page->addPage();
        }
        
        if($arrResp['status']==1){
            // True
            Session::flash('message', "Page has been $action sucessfully."); 
            Session::flash('alert-class', 'alert-success'); 
            Session::flash('icon-class', 'icon fa fa-check');
            return redirect('admin/page');
        } else {
            // False
            Session::flash('message', 'Unabel to save page, please try again later!'); 
            Session::flash('alert-class', 'alert-danger'); 
            Session::flash('icon-class', 'icon fa fa-ban');
            return redirect('admin/page/add');
        }
        
    }
    
    public function delete($id) {
        
        $arrResp = [];
        // New Menu Object
        $page = new Page();
        // Pass Data To Model
        $page->field['id'] = base64_decode($id);
        $arrResp = $page->deletePage();
        // print_r($arrResp); exit('sadsa');
        if($arrResp['status']==1){
            // True
            Session::flash('message', "Page has been deleted sucessfully."); 
            Session::flash('alert-class', 'alert-success'); 
            Session::flash('icon-class', 'icon fa fa-check');
            return redirect('admin/page');
        } else {
            // False
            Session::flash('message', 'Unabel to delete page, please try again later!'); 
            Session::flash('alert-class', 'alert-danger'); 
            Session::flash('icon-class', 'icon fa fa-ban');
            return redirect('admin/page');
        }
        
    }
    
}
