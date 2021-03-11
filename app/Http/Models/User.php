<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';
    public $field;

    public function user_role() {
        return $this->belongsTo('App\Http\Models\UserRole','role_id')
            ->select('id','role','home_page')
            ->where('is_deleted', '=' , 0);
    }
    
    public function getUserDataById($id=0) {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        try {
            $arrData = self::select('id','role_id','name')
                        ->with('user_role')
                        ->where('id','=',$id)
                        ->first(); 
            $status = 1;
            $message = 'success';
            // print("<pre>"); print_r($arrData); exit(' State Model');
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        $arrResp['data'] = $arrData;
        
        return $arrResp;
    }

    public function getDataWithPaginate($paginate = 10, $searchKeyword = '',$role_id = 0) {
        $arrResp = [];
        $arrData = [];
        $status = 0;
        $message = '';
        try {
            $query = self::query();
            $query->select('id', 'role_id', 'name', 'email','status','created_at');
            $query->with('user_role');
            // Search Keyword
            if(!empty($searchKeyword)) {
                $query->Where('name', 'LIKE', '%' . $searchKeyword . '%');
            }
            if(!empty($role_id)) {
                $query->Where('role_id', '=', $role_id);
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

    public function addUser() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $userObj = new User();

            $userObj->name   	= $this->field['name'];
            $userObj->email  	= $this->field['email'];
            $userObj->password  = $this->field['password'];
            $userObj->role_id  	= $this->field['role_id'];
            $userObj->status    = $this->field['status'];

            if($userObj->save()){
                $message = 'User addded successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to add user, please try again later!';
            }
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }
    
    public function updateUser() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $userObj = new User();
            $userObj->id           	= $this->field['id'];
            $userObj->exists       	= true;
            $userObj->name   		= $this->field['name'];
            $userObj->email  		= $this->field['email'];
            $userObj->role_id  		= $this->field['role_id'];
            $userObj->status    	= $this->field['status'];
            // $userObj->password   = $this->field['password'];
            if(!empty($this->field['password'])){
                $userObj->password = $this->field['password'];
            }

            if($userObj->save()){
                $message = 'User updated successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to update user, please try again later!';
            }
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }

    public function deleteUser() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $userObj = new User();
            $userObj->id           = $this->field['id'];
            $userObj->exists       = true;
            $userObj->is_deleted   = 1;
            if($userObj->save()){
                $message = 'User deleted successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to delete user, please try again later!';
            }
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }

    
    
}