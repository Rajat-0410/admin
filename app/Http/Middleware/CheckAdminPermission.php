<?php

namespace App\Http\Middleware;
use App\Http\Models\Permission;
use App\Http\Models\Module;

use Closure, Session;

class CheckAdminPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
//    public function handle($request, Closure $next)
//    {
//        return $next($request);
//    }
    
    /**
     * Check Admin Has Permission To Access Requested Page OR Not
     *
     * @var array
     */
    public function handle($request, Closure $next)
    {
        
        try {
            $routeName = $request->route()->getName();
            // dd($routeName);
            // 
            $arrRoute = explode("/",$routeName);
            $controller = (isset($arrRoute[0]) && !empty($arrRoute[0]) ? $arrRoute[0]:'');
            $action = (isset($arrRoute[1]) && !empty($arrRoute[1]) ? $arrRoute[1]:'');
            // dd($action);

            $userHasPermission = false;
            if(!empty($routeName) && $request->ajax()==false && $request->isMethod('post')==false){
                // 
                $userData = Session::get('user_data');
                $roleId = 0;
                // print("<pre>"); print_r($userData); exit('here');
                if(!empty($userData)){ $roleId = $userData['role_id']; }
                $permissionObj = new Permission();
                $permissionsData = $permissionObj->getModulePermission($roleId);
                $arrModuleIds = [];
                if($permissionsData['status']==1){
                    $arrPerittedModulesData = $permissionsData['data']->toArray();
                    // dd($arrPerittedModulesData);
                    foreach ($arrPerittedModulesData as $key => $arrPerittedModule) {
                        $arrModuleIds[] = $arrPerittedModule['module_id'];
                    }
                } else {
                    //dd($permissionsData);
                    // Throw New Exception
                    throw new \Exception('You can not access this page directly, please contact with Admin to get permission!');
                }
                $moduleObj = new Module();
                $arrModuleData = $moduleObj->getModuleIdByParams($controller,$action);
                // dd($arrModuleData);
                // print("<pre>"); print_r($arrModuleData); exit('here');
                if($arrModuleData['status']==1){
                    $moduleId = $arrModuleData['data']->id;
                    $parentId = $arrModuleData['data']->parent_id;
                    if(in_array($moduleId, $arrModuleIds)){
                       $userHasPermission = true;
                    } /*else if(in_array($parentId, $arrModuleIds)){
                       $userHasPermission = true;
                    }*/ else {
                       $userHasPermission = false;
                    }
                }

                // Redirect OR Permit User For Next Process
                // dd($userHasPermission);
                if($userHasPermission==false){
                    // Throw New Exception
                    throw new \Exception('You can not access this page directly, please contact with Admin to get permission!');
                } else {
                    return $next($request);
                }

            } else {
                // dd('else');
                return $next($request);
            }
            
        } catch (\Exception $ex) {
            $message = $ex->getMessage();
            Session::flash('message', $message); 
            Session::flash('alert-class', 'alert-danger'); 
            Session::flash('icon-class', 'icon fa fa-ban');
            return redirect()->route('dashboard');
        }
        
    }
}
