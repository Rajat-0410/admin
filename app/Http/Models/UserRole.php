<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB, Request, Auth;

class UserRole extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_roles';
    public $field;
    

    public function getDataWithPaginate($paginate = 10, $searchKeyword = '') {
        $arrResp = [];
        $arrData = [];
        $status = 0;
        $message = '';
        try {
            $query = self::query();
            $query->select('id','role', 'status','created_at');
            // Search Keyword
            if(!empty($searchKeyword)) {
                $query->Where('role', 'LIKE', '%' . $searchKeyword . '%');
            }
            $query->where('is_deleted', '=', 0);
            $query->orderBy('created_at', 'desc');
            $arrData = $query->paginate($paginate);            
            // print("<pre>"); print_r($arrData); exit('sadas');
            $message = 'Data';
            $status = 1;
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        $arrResp['data'] = $arrData;

        return $arrResp;
    }

    public static function getUserRole() {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        $arrParent = [];
        $arrParent[''] = 'Select Role';
        try {
            
            $arrData = self::where('status','=',1)->where('is_deleted','=',0)->pluck('role', 'id');
            // print("<pre>"); print_r($arrData); exit('sadas');
            if(count($arrData) > 0){
                foreach ($arrData as $key => $value) {
                    $arrParent[$key] = $value;
                }
                $message = 'Role list';
            } else {
                $message = 'Role not available!';
            }
            $status = 1;
            
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        $arrResp['data'] = $arrParent;
        
        return $arrResp;
    }

    public function addUserRole() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $userRoleObj = new UserRole();
            $userRoleObj->role         = $this->field['name'];
            $userRoleObj->status       = $this->field['status'];
            if($userRoleObj->save()){
                $message = 'User role addded successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to add user role, please try again later!';
            }
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }
    
    public function updateUserRole() {
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
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }
    
  
    public function deleteUserRole() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $userRoleObj = new UserRole();
            $userRoleObj->id           = $this->field['id'];
            $userRoleObj->exists       = true;
            $userRoleObj->is_deleted   = 1;
            if($userRoleObj->save()){
                $message = 'User role deleted successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to delete user role, please try again later!';
            }
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }


    public function getPermissionUserRole($paginate = 10) {
        $arrResp = [];
        $arrData = [];
        $status = 0;
        $message = '';
        try {
            $query = self::query();
            $query->select('id','role', 'status','created_at');
            $query->where('is_deleted', '=', 0);
            $query->orderBy('created_at', 'desc');
            $arrData = $query->paginate($paginate);            
            // print("<pre>"); print_r($arrData); exit('sadas');
            $message = 'Data';
            $status = 1;
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