<?php

namespace App\Http\Controllers\UserPermission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use App\Http\Models\User;
use App\Http\Models\UserRole;
use Illuminate\Support\Facades\Hash;
use App\Http\Models\Module;
use App\Http\Models\Permission;

use Validator, DB;

class UserPermissionController extends Controller
{
    
    public function __construct() {
        parent::__construct();
        $this->viewData['page_title'] = 'User Permissions';
    }
    
   /*
     * @Date    : May 15, 2019
     * @Use     : Show user listing
     * @Params  : -
     * @Cretaed By : SD
     */

    public function index() {
        // Set Sub Page Title
        $this->viewData['page_sub_title'] = 'All Permissions';    
                        
        $paginate = config('constant.PAGINATE');
        $userRoleObj = new UserRole();
        $arrResp = $userRoleObj->getPermissionUserRole($paginate);
        // print("<pre>"); print_r($arrResp); exit('in Controller');
        $allRecords = $arrResp['data'];
        $this->viewData['all_records'] = $allRecords;
        $this->viewData['no_records_found'] = config('constant.NO_RECORDS_FOUND');
        $this->viewData['arr_status'] = config('constant.STATUS');
        return view('user-permission.index',$this->viewData);
    }

    public function add() {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'User Permission';

        // Get user role
        $userRoleObj = new UserRole();
        $roleArr = $userRoleObj->getUserRole();
        $this->viewData['roleArr'] = $roleArr['data'];

        // Get Module
        $moduleObj = new Module();
        $moduleArr = $moduleObj->getAllModule();
        // print("<pre>"); print_r($moduleArr); exit('in controller');
        $this->viewData['moduleArr'] = $moduleArr['data'];
        return view('user-permission.add',$this->viewData);
    }

    public function edit($id) {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'Edit Permission';
        $userRoleId = base64_decode($id);
        $this->viewData['userRoleId'] = $userRoleId;
        // Get user permission
        $permissionObj = new Permission();
        $permissionArr = $permissionObj->getModulePermission($userRoleId);
        $permissionResp  = $permissionArr['data'];
        $permissionValue = [];
        // array prepare
        if(count($permissionResp) > 0){
            foreach($permissionResp as $key =>  $pValue){
                $permissionValue[$pValue->module_id] = $pValue->module_id;
            }
        }
        $this->viewData['permissionArr'] = $permissionValue;
        // Get user role
        $userRoleObj = new UserRole();
        $roleArr = $userRoleObj->getUserRole();
        $this->viewData['roleArr'] = $roleArr['data'];

        // Get Module
        $arrModules = [];
        $moduleObj = new Module();
        $moduleArr = $moduleObj->getAllModule();
        // print("<pre>"); print_r($moduleArr); exit('in controller');
        if($moduleArr['status']==1){
            foreach($moduleArr['data'] as $key => $value){
                // 
                $id = $value->id;
                $name = $value->name;
                $controller = $value->controller;
                $is_action = $value->is_action;
                $is_visible = $value->is_visible;
                $has_sub_menu = $value->has_sub_menu;
                $arrModules[$key] = [
                                    'id' => $id,
                                    'name' => $name,
                                    'controller' => $controller,  
                                    'is_action' => $is_action,
                                    'is_visible' => $is_visible,
                                    'has_sub_menu' => $has_sub_menu,
                                ];
                if($has_sub_menu==1){
                    $arrSubModulesData = $moduleObj->getSubModules($id);
                    if($arrSubModulesData['status']==1){
                        $arrSubModules = $arrSubModulesData['data'];
                        // print("<pre>"); print_r($arrSubModules); exit('in controller');
                        foreach($arrSubModules as $key1 => $value1){
                            $sm_id = $value1->id;
                            $sm_name = $value1->name;
                            $sm_controller = $value1->controller;
                            $sm_action = $value1->action;
                            $sm_is_action = $value1->is_action;
                            $sm_is_visible = $value1->is_visible;
                            $sm_has_sub_menu = $value1->has_sub_menu;
                            // 
                            $arrModules[$key]['sub_modules'][] = [
                                                            'id'          => $sm_id,
                                                            'name'        => $sm_name,
                                                            'controller'  => $sm_controller,
                                                            'action'      => $sm_action,
                                                            'is_action'   => $sm_is_action,
                                                            'is_visible'  => $sm_is_visible,
                                                            'has_sub_menu'=> $sm_has_sub_menu,
                                                        ];
                        }
                    }
                }
            }
        }
        // print("<pre>"); print_r($arrModules); exit('in controller');
        $this->viewData['arrModules'] = $arrModules;
        return view('user-permission.edit',$this->viewData);
    }

    public function store(Request $request) {
        
        $input = $request->all();
        // echo '<pre>'; print_r($input);  exit;
        // Validation => START
        $isUpdate = (isset($input['id']) && !empty($input['id'])) ? true:false;
            $validator = Validator::make($request->all(), [
                'user_role' => 'required',
            ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $moduleArr = [];
        $user_role = $input['user_role'];

        // Previous permission delete code => Start
        $permission = new Permission();
        $permissionArr = $permission->getModulePermission($user_role);
        $permissionResp  = $permissionArr['data'];
        if(count($permissionResp) > 0){
            $permissionDeleteRes = $permission->deletePermission($user_role);
        }
        // Previous permission delete code => End

        if(isset($input['module_id'])) {
            $moduleArr = $input['module_id'];
        }
        if(count($moduleArr) > 0) {
            // Initialize Variables
            $arrResp = [];
            $action = 'added';
            // New Object
            $permissionObj = new Permission();
            // Pass Data To Model
            if($isUpdate){
                // If Update True Pass Data To Model
                $permissionObj->field['userRoleId'] = $input['userRoleId'];
                $action = 'updated';
            }
            
            foreach ($moduleArr as $key => $value) {
                $permissionObj->field['user_role'] = $input['user_role'];
                $permissionObj->field['module_id'] = $value;
                $arrResp = $permissionObj->addPermission();
            }
            
            if($arrResp['status']==1){
                 // True
                 Session::flash('message', "Permission has been $action sucessfully."); 
                 Session::flash('alert-class', 'alert-success'); 
                 Session::flash('icon-class', 'icon fa fa-check');
                 return redirect("admin/user-permission");
             } else {
                 // False
                 Session::flash('message', 'Unabel to save permission, please try again later!'); 
                 Session::flash('alert-class', 'alert-danger'); 
                 Session::flash('icon-class', 'icon fa fa-ban');
                 return redirect("admin/user-permission");
            }
            
        } else {
            // False
            Session::flash('message', 'Module is not checked, please try again later!'); 
            Session::flash('alert-class', 'alert-danger'); 
            Session::flash('icon-class', 'icon fa fa-ban');
            return redirect("admin/user-permission");
        }
          
    }


    // public function softdelete($id) {
        
    //     $arrResp = [];
    //     // New Menu Object
    //     $permission = new Permission();
    //     // Pass Data To Model
    //     $userObj->field['id'] = $id;
    //     $arrResp = $permission->permissionSoftdelete();
    //     // print_r($arrResp); exit('sadsa');
    //     if($arrResp['status']==1){
    //         // True
    //         Session::flash('message', "Permission has been deleted sucessfully."); 
    //         Session::flash('alert-class', 'alert-success'); 
    //         Session::flash('icon-class', 'icon fa fa-check');
    //         return redirect('admin/user-permission');
    //     } else {
    //         // False
    //         Session::flash('message', 'Unabel to delete permission, please try again later!'); 
    //         Session::flash('alert-class', 'alert-danger'); 
    //         Session::flash('icon-class', 'icon fa fa-ban');
    //         return redirect('admin/user-permission');
    //     }
        
    // }

    
        
    
}
