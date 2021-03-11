<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use App\Http\Models\News;
use Validator, DB;

class NewsController extends Controller
{
    
    public function __construct() {
        parent::__construct();
        $this->viewData['page_title'] = 'News';
    }
    
    /*
     * @Date    : Feb 11, 2019
     * @Use     : Show menu listing
     * @Params  : -
     * @Cretaed By : SG
     */
    public function index(Request $request) {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'All News';
        $input = $request->all();
        $keyword = '';
        $category_id = 0;
        if(isset($input['keyword']) && !empty($input['keyword'])){
           $keyword = $input['keyword'];
        }
        if(isset($input['category_id']) && !empty($input['category_id'])){
           $category_id = $input['category_id'];
        }

        $paginate = config('constant.PAGINATE');
        $newsObj = new News();
        $arrResp = $newsObj->getDataWithPaginate($paginate,$keyword,$category_id);
        
        // print("<pre>"); print_r($arrResp); exit('sadas');
        $allRecords = $arrResp['data'];
        $this->viewData['all_records'] = $allRecords;
        $this->viewData['keyword'] = $keyword;
        $this->viewData['category_id'] = $category_id;
        $this->viewData['no_records_found'] = config('constant.NO_RECORDS_FOUND');
        return view('news.index',$this->viewData);
    }
    
    /*
     * @Date    : Feb 11, 2019
     * @Use     : Add New Menu
     * @Params  : -
     * @Cretaed By : SG
     */
    public function add() {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'Add New News';
                
        $this->viewData['arr_status'] = config('constant.STATUS');
        $this->viewData['allowfiletypetext'] = config('constant.ALLOW_FILE_TYPE_TEXT');
        $this->viewData['filetype'] = config('constant.File_TYPE');
        
        $carrent_date_time = date('d-m-Y h:i:s');
        $publishDate = \Carbon\Carbon::parse($carrent_date_time)->format('d-m-Y h:i A');
        $this->viewData['publish_date'] = $publishDate;
        
        return view('news.add',$this->viewData);
    }
    
    /*
     * @Date    : Feb 11, 2019
     * @Use     : Add New Menu
     * @Params  : -
     * @Cretaed By : SG
     */
    public function edit($id) {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'Edit News';
        $news = News::find(base64_decode($id));
        $this->viewData['id'] = $news->id;
        $this->viewData['title'] = $news->title;
        $this->viewData['slug'] = $news->slug;
        $this->viewData['category_id'] = $news->category_id;
        $this->viewData['featured_image'] = $news->featured_image;
        $this->viewData['short_description'] = $news->short_description;
        $this->viewData['content'] = $news->content;
        $this->viewData['status'] = $news->status;
        $publish_date = $news->publish_date;
        $publishDate = \Carbon\Carbon::parse($publish_date)->format('d-m-Y h:i A');
        $this->viewData['publish_date'] = $publishDate;
        
        $this->viewData['arr_status'] = config('constant.STATUS');
        $this->viewData['allowfiletypetext'] = config('constant.ALLOW_FILE_TYPE_TEXT');
        $this->viewData['filetype'] = config('constant.File_TYPE');
                
        return view('news.edit',$this->viewData);
    }
    
    public function store(Request $request) {
        
        $input = $request->all();
        // Action
        $isUpdate = (isset($input['id']) && !empty($input['id'])) ? true:false;
        // echo '<pre>'; print_r($input); exit;
        // Validation => START
        $validator = Validator::make($request->all(), [
            'title' => 'required'
        ]);
        if ($validator->fails()) {
            // return redirect('admin/news/add')->withErrors($validator)->withInput();
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Validation => END
        // Initialize Variables
        $arrResp = [];
        $action = 'added';
        // New Menu Object
        $news = new News();
        // Pass Data To Model
        if($isUpdate){
            // If Update True Pass Data To Model
            $news->field['id'] = $input['id'];
            $news->field['slug'] = $input['slug'];
            $action = 'updated';
        }
        
        // Convert Date Time
        $publish_date = $input['publish_date'];
        $publishDate = \Carbon\Carbon::parse($publish_date)->format('Y-m-d H:i:s');
        // dd($publishDate);
        
        $news->field['title'] = $input['title'];
        $news->field['featured_image'] = $input['featured_image'];
        $news->field['short_description'] = $input['short_description'];
        $news->field['content'] = $input['content'];
        $news->field['status'] = $input['status'];
        $news->field['publish_date'] = $publishDate;
        
        // Slug Creation => START | This should be here
        $arrResp = $news->createSlug();
        // echo '<pre>'; print_r($arrResp); exit;
        $str_slug = '';
        if($arrResp['status']==0){
            throw new \Exception($arrResp['message']);
        } else {
            $str_slug = $arrResp['str_slug'];
        }
        $news->field['slug'] = $str_slug;
        // Slug Creation => END
        
        if($isUpdate){
            // If Update
            $arrResp = $news->updateNews();
        } else {
            // If Add
            $arrResp = $news->addNews();
        }
        
        if($arrResp['status']==1){
            // True
            Session::flash('message', "News has been $action sucessfully."); 
            Session::flash('alert-class', 'alert-success'); 
            Session::flash('icon-class', 'icon fa fa-check');
            return redirect('admin/news');
        } else {
            // False
            Session::flash('message', 'Unabel to save news, please try again later!'); 
            Session::flash('alert-class', 'alert-danger'); 
            Session::flash('icon-class', 'icon fa fa-ban');
            return redirect('admin/news/add');
        } 
    }
    
    public function delete($id) {
        
        $arrResp = [];
        // New Menu Object
        $news = new News();
        // Pass Data To Model
        $news->field['id'] = base64_decode($id);
        $arrResp = $news->deleteNews();
        // print_r($arrResp); exit('sadsa');
        if($arrResp['status']==1){
            // True
            Session::flash('message', "News has been deleted sucessfully."); 
            Session::flash('alert-class', 'alert-success'); 
            Session::flash('icon-class', 'icon fa fa-check');
            return redirect('admin/news');
        } else {
            // False
            Session::flash('message', 'Unabel to delete news, please try again later!'); 
            Session::flash('alert-class', 'alert-danger'); 
            Session::flash('icon-class', 'icon fa fa-ban');
            return redirect('admin/news');
        }
    }

    // public function view($id)
    // {
    //      // echo "<pre>";
    //      // echo($id);
    //      // exit("ID ayi hai bhaiyya");
    //      $arrResp = []; 
    //      $news = News::find(base64_decode($id));
    //      $arrResp = $news->viewNews();
    //     // echo "<pre>"; print_r($arrResp); exit('in controller');
    //      $responseData = [];
    //     if($arrResp['status'] == 1)
    //     {
    //        $responseData = $arrResp['data'];
    //     } 
    //     $this->ViewData['news'] = $responseData;
    //     return view('news.news_detail',$this->ViewData);
    // } 


    public function view($id)
    {
         // echo "<pre>";
         // echo($id);
         // exit("ok");
         $arrResp = []; 
         $news = new News();
         $arrResp = $news->getDetails(base64_decode($id));
        // echo "<pre>"; print_r($arrResp); exit('in controller');
         $responseData = [];
        if($arrResp['status'] == 1)
        {
           $responseData = $arrResp['data'];
        } 
        $this->ViewData['news'] = $responseData;
        return view('news.news_detail',$this->ViewData);
    } 

}
