<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permissions';
    public $field;
    
    public function get_modules() {
        return $this->belongsTo('App\Http\Models\Module','module_id')
            ->select('id','name','controller','action','is_visible')
                ->where('status','=',1)->where('is_deleted','=',0)->orderBy('order_by','ASC');
    }
        
    public static function getModulePermissionsByRoleId($roleId=0) {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        try {
            
            $query = self::query();
            $query->select('permissions.id',
                            'permissions.role_id',
                            'permissions.module_id',
                            'm.name',
                            'm.fa_icon',
                            'm.controller',
                            'm.action',
                            'm.has_sub_menu',
                            'm.is_visible'
//                            ,
//                            'sm.name as sm_name',
//                            'sm.fa_icon as sm_fa_icon',
//                            'sm.controller as sm_controller',
//                            'sm.action as sm_action',
//                            'sm.has_sub_menu as sm_has_sub_menu',
//                            'sm.is_visible as sm_is_visible'
                        );
            // $query->with('get_modules');
            // $query->join('modules', 'permissions.module_id', '=', 'modules.id');
            $query->join('modules as m', function ($join) {
                $join->on('permissions.module_id', '=', 'm.id')
                    ->where('m.status', '=', 1)
                    ->where('m.is_deleted', '=', 0)
                    ->where('m.parent_id', '=', 0);
            });
//            $query->leftJoin('modules as sm', function ($join1) {
//                $join1->on('permissions.module_id', '=', 'sm.parent_id')
//                ->where('sm.status', '=', 1)
//                ->where('sm.is_deleted', '=', 0)
//                ->where('m.parent_id', '!=', 0)
//                ->orderBy('m.order_by','asc');
//            });
            $query->where('permissions.role_id','=',$roleId);
            $query->where('permissions.is_deleted','=',0);
            $query->where('permissions.status','=',1);
            $query->orderBy('m.order_by','asc');
            $query->groupBy('module_id');
            $arrData = $query->get();
            // print("<pre>"); print_r($arrData); exit('sadas');
            
            $status = 1;
            $message = 'success';
            
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        $arrResp['data'] = $arrData;
        
        return $arrResp;
    }
    
    public static function getModulePermission($roleId) {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        $arrParent = [];
        try {
            
            $query = self::query();
            $query->select('id','module_id','role_id');
            $query->where('is_deleted','=',0);
            $query->where('status','=',1);
            $query->where('role_id','=',$roleId);
            $arrData = $query->get();
            // print("<pre>"); print_r($arrData); exit('sadas');
            if(count($arrData) > 0){
                $status = 1;
                $arrParent = $arrData;
                $message = 'Module list';
            } else {
                throw new \Exception('Requested module doen not exist, please try again!');
                // $message = 'Module not available!';
            }
            
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        $arrResp['data'] = $arrParent;
        
        return $arrResp;
    }
    
    public function addPermission() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $permissionObj = new Permission();
            $permissionObj->role_id = $this->field['user_role'];
            $permissionObj->module_id = $this->field['module_id'];
            if($permissionObj->save()){
                $message = 'User permission addded successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to add user permission, please try again later!';
            }
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }
    
    public function updatePermission() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $userRoleObj = new UserRole();
            $userRoleObj->id           = $this->field['id'];
            $userRoleObj->exists       = true;
            $userRoleObj->role         = $this->field['name'];
            $userRoleObj->status       = $this->field['status'];
            if($userRoleObj->save()){
                $message = 'User role updated successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to update user role, please try again later!';
            }
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }
    
    public function deletePermission($roleId=0) {
       $arrResp    = [];
       $status     = 0;
       $message    = '';
       try {
            $query = self::query();
            $query->where('role_id','=',$roleId);
           if($query->delete()){
               $message = 'Permission delete successfully.';
               $status = 1;
           } else {
               $status = 0;
               $message = 'Unabel to delete permission, please try again later!';
           }
       } catch (\Exception $ex) {
           $status = 0;
           $message = $ex->getMessage();
       }
       $arrResp['status'] = $status;
       $arrResp['message'] = $message;
       return $arrResp;
    }
    
    public function getAllPermissionsList($roleId=0) {
        $status     = 0;
        $message    = '';
        $arrResp    = [];
        $arrData    = [];
        try {
            $query = self::query();
            $query->where('is_deleted','=',0);
            $query->where('status','=',1);
            $query->where('role_id','=',$roleId);
            $arrData = $query->pluck('module_id');
            // print("<pre>"); print_r($arrData); exit('sadas');
            if(!empty($arrData)){
                $status = 1;
                $message = 'success';
            } else {
                $status = 0;
                $message = 'failed!';
            }
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        $arrResp['data'] = $arrData;
        return $arrResp;
    }
    
    public static function getModuleActionPermissions($roleId,$arrControllers=[]) {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        // dd($arrControllers);
        try {
            // 
            $query = self::query();
            $query->select(
                            'permissions.id',
                            'permissions.module_id',
                            'permissions.role_id',
                            'modules.name',
                            'modules.controller',
                            'modules.action'
                        );
            $query->join('modules', function($join) use($arrControllers){
                $join->on('permissions.module_id', '=', 'modules.id');
                $join->whereIn('modules.controller', $arrControllers);
                $join->where('modules.is_action', '=', 1);
            });
            $query->where('permissions.is_deleted','=',0);
            $query->where('permissions.status','=',1);
            $query->where('permissions.role_id','=',$roleId);
            $arrData = $query->get();
            // print("<pre>"); print_r($arrData->toArray()); exit('sadas');
            if(!empty($arrData)){
                $status = 1;
                $message = 'Module list';
            }
            
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        $arrResp['data'] = $arrData;
        return $arrResp;
    }
}