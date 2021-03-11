<?php

namespace App\Http\Controllers\Menu;

use Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Menu;
use Validator, DB;


class MenuController extends Controller
{
    
    public function __construct() {
        parent::__construct();
        $this->viewData['page_title'] = 'Menus';
    }
    
    /*
     * @Date    : Feb 11, 2019
     * @Use     : Show menu listing
     * @Params  : -
     * @Cretaed By : SG
     */
    public function index() {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'All Menu/s';
        
        $paginate = config('constant.PAGINATE');
        $allRecords = DB::table('menus as m')
                        ->select('m.id','m.name','m.slug','m.group_id','m.page_id','m.status','m.is_deleted','m.created_at','m1.id as parent_id','m1.name as parent_name')
                        ->leftJoin('menus as m1', 'm.parent_id', '=', 'm1.id')
                        ->where('m.is_deleted','=',0)
                        ->orderBy('m.created_at', 'desc')
                        ->paginate($paginate);
        
        $this->viewData['all_records'] = $allRecords;
        $this->viewData['no_records_found'] = config('constant.NO_RECORDS_FOUND');
        
        $menu_types = config('constant.MENU_TYPES');
        $this->viewData['menu_types'] = $menu_types;
        
        // print("<pre>"); print_r($allRecords); exit('here');
        
        return view('menu.index',$this->viewData);
    }
    
    /*
     * @Date    : Feb 11, 2019
     * @Use     : Add New Menu
     * @Params  : -
     * @Cretaed By : SG
     */
    public function add() {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'Add New Menu';
        
        // Get Main Menus
        $menu = new Menu();
        $parentMenu = $menu->getMainMenusList();
        $this->viewData['parent_menus'] = $parentMenu['data'];
        
        
        // Get Pages List
        $pages = new \App\Http\Models\Page;
        $pagesList = $pages->getPagesList();
        $this->viewData['pages_list'] = $pagesList['data'];
        
        // Menu Types Array
        $menu_types = config('constant.MENU_TYPES');
        $this->viewData['menu_types'] = $menu_types;
        
        return view('menu.add',$this->viewData);
    }
    
    /*
     * @Date    : Feb 11, 2019
     * @Use     : Add New Menu
     * @Params  : -
     * @Cretaed By : SG
     */
    public function edit($id) {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'Edit Menu';
        $menu = Menu::find(base64_decode($id));
        $this->viewData['id'] = $menu->id;
        $this->viewData['group_id'] = $menu->group_id;
        $this->viewData['parent_id'] = $menu->parent_id;
        $this->viewData['name'] = $menu->name;
        $this->viewData['slug'] = $menu->slug;
        $this->viewData['page_id'] = $menu->page_id;
        $this->viewData['status'] = $menu->status;
        // echo '<pre>'; print_r($this->viewData); exit;
        
        // Get Main Menus
        $menu = new Menu();
        $parentMenu = $menu->getMainMenusList();
        $this->viewData['parent_menus'] = $parentMenu['data'];
        
        // Get Pages List
        $pages = new \App\Http\Models\Page;
        $pagesList = $pages->getPagesList();
        $this->viewData['pages_list'] = $pagesList['data'];
        
        // Menu Types Array
        $menu_types = config('constant.MENU_TYPES');
        $this->viewData['menu_types'] = $menu_types;
        
        return view('menu.edit',$this->viewData);
    }
    
    public function store(Request $request) {
        
        $input = $request->all();
        // echo '<pre>'; print_r($input); exit;
        // Validation => START
        $validator = Validator::make($request->all(), [
            'group_id'   => 'required',
            'name'      => 'required',
            'page_id'   => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Validation => END
        // Initialize Variables
        $arrResp = [];
        $action = 'added';
        // Action
        $isUpdate = (isset($input['id']) && !empty($input['id'])) ? true:false;
        // New Menu Object
        $menu = new Menu();
        // Pass Data To Model
        if($isUpdate){
            // If Update True Pass Data To Model
            $menu->field['id'] = $input['id'];
            $menu->field['slug'] = $input['slug'];
            $action = 'updated';
        }
        $menu->field['group_id'] = $input['group_id'];
        $menu->field['parent_id'] = $input['parent_id'];
        $menu->field['name'] = $input['name'];
        $menu->field['page_id'] = $input['page_id'];
        $menu->field['status'] = $input['status'];
        
        // Slug Creation => START | This should be here
        $arrResp = $menu->createSlug();
        // echo '<pre>'; print_r($arrResp); exit;
        $str_slug = '';
        if($arrResp['status']==0){
            throw new \Exception($arrResp['message']);
        } else {
            $str_slug = $arrResp['str_slug'];
        }
        $menu->field['slug'] = $str_slug;
        // Slug Creation => END
        
        if($isUpdate){
            // If Update
            $arrResp = $menu->updateMenu();
        } else {
            // If Add
            $arrResp = $menu->addMenu();
        }
        
        if($arrResp['status']==1){
            // True
            Session::flash('message', "Menu has been $action sucessfully."); 
            Session::flash('alert-class', 'alert-success'); 
            Session::flash('icon-class', 'icon fa fa-check');
            return redirect('admin/menu');
        } else {
            // False
            Session::flash('message', 'Unabel to save menu, please try again later!'); 
            Session::flash('alert-class', 'alert-danger'); 
            Session::flash('icon-class', 'icon fa fa-ban');
            return redirect('admin/menu/add');
        }
        
    }
    
    public function delete($id) {
        
        $arrResp = [];
        // New Menu Object
        $menu = new Menu();
        // Pass Data To Model
        $menu->field['id'] = base64_decode($id);
        $arrResp = $menu->deleteMenu();
        // print_r($arrResp); exit('sadsa');
        if($arrResp['status']==1){
            // True
            Session::flash('message', "Menu has been deleted sucessfully."); 
            Session::flash('alert-class', 'alert-success'); 
            Session::flash('icon-class', 'icon fa fa-check');
            return redirect('admin/menu');
        } else {
            // False
            Session::flash('message', 'Unabel to delete menu, please try again later!'); 
            Session::flash('alert-class', 'alert-danger'); 
            Session::flash('icon-class', 'icon fa fa-ban');
            return redirect('admin/menu');
        }
        
    }
}
