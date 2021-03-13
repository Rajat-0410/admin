<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Menu;
use App\Http\Models\Module;
use App\Http\Models\Permission;

use View, Route, Artisan, Cookie;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    /*
     * Controller constructor.
     */
    public function __construct(){
        
        // Define SITE_URL Constant For Url's
        define('SITE_URL', getenv('APP_URL'));
        define('DS', DIRECTORY_SEPARATOR);
        // For Help Text
        define('MAX_SIZE_TEXT', 'Max Size:');
        
        // Get Route Name
        $routeName = '';
        $routeName = Route::currentRouteName();
        $this->viewData['route_name'] = $routeName;
        $arrRoute = explode("/",$routeName);
        $controller = (isset($arrRoute[0]) && !empty($arrRoute[0]) ? $arrRoute[0]:'');
        $action = (isset($arrRoute[1]) && !empty($arrRoute[1]) ? $arrRoute[1]:'');
        $this->viewData['get_controller'] = $controller;
        $this->viewData['get_action'] = $action;
        // echo $routeName; exit('here');
        
        // Get Route Data
        $arrRouteData = Route::getCurrentRoute()->getAction();
        // print("<pre>"); print_r($arrRouteData); exit;
        $prefix = str_replace('/', '', $arrRouteData['prefix']);
        // echo $prefix; exit;
        
        $arrExceptRoutes = ['authority','signout'];
        $arrPerittedModulesData = [];
        $userData = Session::get('user_data');
        $arrAdminMainMenu = [];
        $add_action = false;
        $edit_action = false;
        $delete_action = false;
        // 
        $moduleObj = new Module();
        $permissionObj = new Permission();
        // $arrExceptRoutes = ['authority','signout','home','products','racing','accessories','support','career','about-us'];
        // var_dump(in_array($routeName, $arrExceptRoutes)); exit;
        if($prefix=='admin' && !in_array($routeName, $arrExceptRoutes) && !empty($userData)){
            $roleId = 0;
            // print("<pre>"); print_r($userData); exit('here');
            if(!empty($userData)){ $roleId = $userData['role_id']; }
            // 
            $arrPermissionsList = [];
            $arrPermissionsListData = $permissionObj->getAllPermissionsList($roleId);
            if($arrPermissionsListData['status']==1){
                $arrPermissionsList = $arrPermissionsListData['data']->toArray();
            }
            // 
            //if(empty(Session::get('arr_admin_main_menu'))){
                $modulePermissionsData = $permissionObj->getModulePermissionsByRoleId($roleId);
                // dd($modulePermissionsData);
                if($modulePermissionsData['status']==1){
                    $arrPerittedModulesData = $modulePermissionsData['data']->toArray();
                    // print("<pre>"); print_r($arrPermissionsList); exit('here');
                    foreach ($arrPerittedModulesData as $key => $arrPerittedModule) {
                        $arrAdminSumMenus = [];
                        $id = $arrPerittedModule['module_id'];
    //                    $name = $arrPerittedModule['name'];
    //                    $fa_icon = $arrPerittedModule['fa_icon'];
    //                    $controller = $arrPerittedModule['controller'];
    //                    $action = $arrPerittedModule['action'];                        
    //                    $is_visible = (bool)$arrPerittedModule['is_visible'];
                        $has_sub_menu = (bool)$arrPerittedModule['has_sub_menu'];
                        $arrAdminMainMenu[$key] = $arrPerittedModule;
                        if($has_sub_menu){
                            $arrSubModulesData = $moduleObj->getSubModules($id);
                            if($arrSubModulesData['status']==1){
                                $arrAdminSumMenusData = $arrSubModulesData['data']->toArray();
                                // print("<pre>"); print_r($arrAdminSumMenusData); exit('here');
                                // $arrPermissionsList
                                foreach ($arrAdminSumMenusData as $sm_key => $sm_value) {
                                    if(in_array($sm_value['module_id'], $arrPermissionsList)){
                                        // echo $sm_value['module_id'];
                                        $arrAdminSumMenus[] = $sm_value;
                                    }
                                }
                            }
                            // print("<pre>"); print_r($arrAdminSumMenus); exit('here');
                        }
                        $arrAdminMainMenu[$key]['sub_menus'] = $arrAdminSumMenus;
                    }                
                }
                // Set Admin Menu Into Session
                // Session::put('arr_admin_main_menu',$arrAdminMainMenu);
            //}
            // print("<pre>"); print_r($arrAdminMainMenu); exit('Permission');
              
            // Get Action By Controllers =>START
            $arrRoute = explode("/",$routeName);
            $controller = (isset($arrRoute[0]) && !empty($arrRoute[0]) ? $arrRoute[0]:'');
            $action = (isset($arrRoute[1]) && !empty($arrRoute[1]) ? $arrRoute[1]:'');
            $permissionObj = new \App\Http\Models\Permission();
            $userData = Session::get('user_data');
            $roleId = (!empty($userData) ? $userData['role_id']:0);
            $arrControllers = ["$controller"];
            $arrModuleActionPermissions = $permissionObj->getModuleActionPermissions($roleId,$arrControllers);
            if($arrModuleActionPermissions['status']==1) {
                foreach($arrModuleActionPermissions['data'] as $key => $value){
                    $controller = $value->controller;
                    $action = $value->action;
                    if($action=='add'){ $add_action = true; }
                    if($action=='edit'){ $edit_action = true; }
                    if($action=='delete'){ $delete_action = true; }
                }
            }
            // print("<pre>"); print_r($arrModuleActionPermissions); exit('sadas');
            // Get Action By Controllers => END
        }
        // 
        $this->viewData['add_action'] = $add_action;
        $this->viewData['edit_action'] = $edit_action;
        $this->viewData['delete_action'] = $delete_action;        
        $this->viewData['user_data'] = $userData; // Session::get('arr_admin_main_menu');
        $this->viewData['arr_admin_main_menu'] = $arrAdminMainMenu; // Session::get('arr_admin_main_menu');
        // print("<pre>"); print_r($this->viewData['add_action']); exit('all'); 
        
        // Menu Groups Are Initialized In Constant File
        $menu = new Menu();
        // Get Main Menus
        $groupId = 1;
        $arrMainMenu = $menu->getMenusWithSubMenus($groupId);
        // print("<pre>"); print_r($arrMainMenu); exit('all');
        $this->viewData['main_menu'] = $arrMainMenu['data'];;
        // Get Header Menus
        $groupId = 2;
        $arrHeaderMenu = $menu->getMenusByGroup($groupId);
        $this->viewData['header_menu'] = $arrHeaderMenu['data'];
        // Get Footer Menus
        $groupId = 4;
        $arrHeaderMenu = $menu->getMenusByGroup($groupId);
        $this->viewData['footer_menu'] = $arrHeaderMenu['data'];
        // Get Sub-Footer Menus
        $groupId = 5;
        $arrHeaderMenu = $menu->getMenusByGroup($groupId);
        $this->viewData['sub_footer_menu'] = $arrHeaderMenu['data'];
        // print("<pre>"); print_r($this->viewData); exit('all');    
        
        // getCookie
        $homeodocs_cookie_policy = Cookie::get('homeodocs_cookie_policy');
        $this->viewData['homeodocs_cookie_policy'] = $homeodocs_cookie_policy;
        // dd($homeodocs_cookie_policy);
    }
    
}
