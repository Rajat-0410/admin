<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Post;
use App\Http\Models\Category;
use Validator, DB;


class PostController extends Controller
{
    
    public function __construct() {
        parent::__construct();
        $this->viewData['page_title'] = 'Posts';
    }
    
    /*
     * @Date    : Feb 11, 2019
     * @Use     : Show menu listing
     * @Params  : -
     * @Cretaed By : SG
     */
    public function index(Request $request) {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'All Posts';
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
        $postObj = new Post();
        $arrResp = $postObj->getDataWithPaginate($paginate,$keyword,$category_id);

        // get post category
        $category = new Category();
        $arrCategoriesResp = $category->getAllCategories();
        $this->viewData['arrCategories'] = $arrCategoriesResp['data'];
        
        // print("<pre>"); print_r($arrResp); exit('sadas');
        $allRecords = $arrResp['data'];
        $this->viewData['all_records'] = $allRecords;
        $this->viewData['keyword'] = $keyword;
        $this->viewData['category_id'] = $category_id;
        $this->viewData['no_records_found'] = config('constant.NO_RECORDS_FOUND');
        return view('post.index',$this->viewData);
    }
    
    /*
     * @Date    : Feb 11, 2019
     * @Use     : Add New Menu
     * @Params  : -
     * @Cretaed By : SG
     */
    public function add() {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'Add New Post';
        
        // New Category Object
        $category = new Category();
        $arrResp = $category->getCategories();
        $this->viewData['arrCategories'] = $arrResp['data'];
        
        $this->viewData['arr_status'] = config('constant.STATUS');
        $this->viewData['allowfiletypetext'] = config('constant.ALLOW_FILE_TYPE_TEXT');
        $this->viewData['filetype'] = config('constant.File_TYPE');
        
        return view('post.add',$this->viewData);
    }
    
    /*
     * @Date    : Feb 11, 2019
     * @Use     : Add New Menu
     * @Params  : -
     * @Cretaed By : SG
     */
    public function edit($id) {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'Edit Post';
        $post = Post::find(base64_decode($id));
        $this->viewData['id'] = $post->id;
        $this->viewData['title'] = $post->title;
        $this->viewData['slug'] = $post->slug;
        $this->viewData['share_url'] = $post->share_url;
        $this->viewData['category_id'] = $post->category_id;
        $this->viewData['featured_image'] = $post->featured_image;
        $this->viewData['short_content'] = $post->short_content;
        $this->viewData['content'] = $post->content;
        $this->viewData['status'] = $post->status;
        $this->viewData['publish_date'] = date('Y-m-d', strtotime($post->publish_date));
        // echo '<pre>'; print_r($this->viewData); exit;
        
        $this->viewData['arr_status'] = config('constant.STATUS');
        $this->viewData['allowfiletypetext'] = config('constant.ALLOW_FILE_TYPE_TEXT');
        $this->viewData['filetype'] = config('constant.File_TYPE');
        
        // Get Categories
        // New Category Object
        $category = new Category();
        $arrResp = $category->getCategories();
        $this->viewData['arrCategories'] = $arrResp['data'];
        
        return view('post.edit',$this->viewData);
    }
    
    public function store(Request $request) {
        
        $input = $request->all();
        // Action
        $isUpdate = (isset($input['id']) && !empty($input['id'])) ? true:false;
        // echo '<pre>'; print_r($input); exit;
        // Validation => START
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required'
        ]);
        if ($validator->fails()) {
            // return redirect('admin/post/add')->withErrors($validator)->withInput();
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Validation => END
        // Initialize Variables
        $arrResp = [];
        $action = 'added';
        // New Menu Object
        $post = new Post();
        // Pass Data To Model
        if($isUpdate){
            // If Update True Pass Data To Model
            $post->field['id'] = $input['id'];
            $post->field['slug'] = $input['slug'];
            $action = 'updated';
        }
        
        $post->field['title'] = $input['title'];
        $post->field['share_url'] = $input['share_url'];
        $post->field['category_id'] = $input['category_id'];
        $post->field['featured_image'] = $input['featured_image'];
        $post->field['content'] = $input['content'];
        $post->field['short_content'] = $input['short_content'];
        $post->field['status'] = $input['status'];
        $post->field['publish_date'] = $input['publish_date'];
        
        // Slug Creation => START | This should be here
        $arrResp = $post->createSlug();
        // echo '<pre>'; print_r($arrResp); exit;
        $str_slug = '';
        if($arrResp['status']==0){
            throw new \Exception($arrResp['message']);
        } else {
            $str_slug = $arrResp['str_slug'];
        }
        $post->field['slug'] = $str_slug;
        // Slug Creation => END
        
        if($isUpdate){
            // If Update
            $arrResp = $post->updatePost();
        } else {
            // If Add
            $arrResp = $post->addPost();
        }
        
        if($arrResp['status']==1){
            // True
            Session::flash('message', "Post has been $action sucessfully."); 
            Session::flash('alert-class', 'alert-success'); 
            Session::flash('icon-class', 'icon fa fa-check');
            return redirect('admin/post');
        } else {
            // False
            Session::flash('message', 'Unabel to save post, please try again later!'); 
            Session::flash('alert-class', 'alert-danger'); 
            Session::flash('icon-class', 'icon fa fa-ban');
            return redirect('admin/post/add');
        }
        
    }
    
    public function delete($id) {
        
        $arrResp = [];
        // New Menu Object
        $post = new Post();
        // Pass Data To Model
        $post->field['id'] = base64_decode($id);
        $arrResp = $post->deletePost();
        // print_r($arrResp); exit('sadsa');
        if($arrResp['status']==1){
            // True
            Session::flash('message', "Post has been deleted sucessfully."); 
            Session::flash('alert-class', 'alert-success'); 
            Session::flash('icon-class', 'icon fa fa-check');
            return redirect('admin/post');
        } else {
            // False
            Session::flash('message', 'Unabel to delete post, please try again later!'); 
            Session::flash('alert-class', 'alert-danger'); 
            Session::flash('icon-class', 'icon fa fa-ban');
            return redirect('admin/post');
        }
        
    }
    
    /*
     * @Date    : Feb 11, 2019
     * @Use     : Show menu listing
     * @Params  : -
     * @Cretaed By : SG
     */
    public function category_index(Request $request) {
        // Set Page Title
        // $this->viewData['page_title'] = 'Categories';
        // Set Sub Page Title
        $this->viewData['page_sub_title'] = 'All Categories';
        $input = $request->all();
        $getId=0;
        $keyword = '';
        if(isset($input['id']) && !empty($input['id'])){
           $getId = $input['id'];
        }
        if(isset($input['keyword']) && !empty($input['keyword'])){
           $keyword = $input['keyword'];
        }
        // 
        $paginate = config('constant.PAGINATE');
        $categoryObj = new Category();
        $arrResp = $categoryObj->getDataWithPaginate($paginate,$keyword);
        $allRecords = $arrResp['data'];
        $this->viewData['all_records'] = $allRecords;
        $this->viewData['keyword'] = $keyword;
        $this->viewData['no_records_found'] = config('constant.NO_RECORDS_FOUND');


        // print("<pre>"); print_r($this->viewData); exit('sadas');
        
        // New Category Object
        $category = new Category();
        $arrResp = $category->getCategories();
        $this->viewData['arrParentCategory'] = $arrResp['data'];
        
        $this->viewData['arr_status'] = config('constant.STATUS');
        
        $btn_name = 'Add';
        $parent_id = '';
        $name = '';
        $slug = '';
        $description = '';
        $status = 1;
        if(!empty($getId)){
            // echo $getId; exit('here');
            $category = Category::find(base64_decode($getId));
            $getId = $category->id;
            $parent_id = $category->parent_id;
            $name = $category->name;
            $slug = $category->slug;
            $description = $category->description;
            $status = $category->status;
            $btn_name = 'Update';
        }
        $this->viewData['get_id']       = $getId;
        $this->viewData['parent_id']    = $parent_id;
        $this->viewData['name']         = $name;
        $this->viewData['slug']         = $slug;
        $this->viewData['description']  = $description;
        $this->viewData['status']       = $status;
        // 
        $this->viewData['btn_name']     = $btn_name;
        // echo '<pre>'; print_r($this->viewData); exit;
        
        return view('post.category_index',$this->viewData);
    }
    
    public function category_store(Request $request) {
        
        $input = $request->all();
        // echo '<pre>'; print_r($input); exit;
        // Validation => START
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('admin/post/category')->withErrors($validator)->withInput();
        }
        // Validation => END
        // Initialize Variables
        $arrResp = [];
        $action = 'added';
        // Action
        $isUpdate = (isset($input['id']) && !empty($input['id'])) ? true:false;
        // New Menu Object
        $category = new Category();
        // Pass Data To Model
        if($isUpdate){
            // If Update True Pass Data To Model
            $category->field['id'] = $input['id'];
            $category->field['slug'] = $input['slug'];
            $action = 'updated';
        }
        $category->field['name'] = $input['name'];
        $category->field['parent_id'] = $input['parent_id'];
        $category->field['description'] = $input['description'];
        $category->field['status'] = $input['status'];
        
        // Slug Creation => START | This should be here
        $arrResp = $category->createSlug();
        // echo '<pre>'; print_r($arrResp); exit;
        $str_slug = '';
        if($arrResp['status']==0){
            throw new \Exception($arrResp['message']);
        } else {
            $str_slug = $arrResp['str_slug'];
        }
        $category->field['slug'] = $str_slug;
        // Slug Creation => END
        
        if($isUpdate){
            // If Update
            $arrResp = $category->updateCategory();
        } else {
            // If Add
            $arrResp = $category->addCategory();
        }
        
        if($arrResp['status']==1){
            // True
            Session::flash('message', "Category has been $action sucessfully."); 
            Session::flash('alert-class', 'alert-success'); 
            Session::flash('icon-class', 'icon fa fa-check');
            return redirect('admin/post/category');
        } else {
            // False
            Session::flash('message', 'Unabel to save category, please try again later!'); 
            Session::flash('alert-class', 'alert-danger'); 
            Session::flash('icon-class', 'icon fa fa-ban');
            return redirect('admin/post/category');
        }
        
    }
    
    public function category_delete($id) {
        
        $arrResp = [];
        // New Category Object
        $category = new Category();
        // Pass Data To Model
        $category->field['id'] = base64_decode($id);
        $arrResp = $category->deleteCategory();
        // print_r($arrResp); exit('sadsa');
        if($arrResp['status']==1){
            // True
            Session::flash('message', "Category has been deleted sucessfully."); 
            Session::flash('alert-class', 'alert-success'); 
            Session::flash('icon-class', 'icon fa fa-check');
            return redirect('admin/post/category');
        } else {
            // False
            Session::flash('message', 'Unabel to delete category, please try again later!'); 
            Session::flash('alert-class', 'alert-danger'); 
            Session::flash('icon-class', 'icon fa fa-ban');
            return redirect('admin/post/category');
        }
        
    }
    
}
