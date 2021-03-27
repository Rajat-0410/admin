<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'patient';
    public $field;

    public function user() {
        return $this->belongsTo('App\Http\Models\User','user_id')
            ->select('id','name','email','mobile','address')
            ->where('is_deleted', '=' , 0);
    }
    public function medica_record() {
        return $this->hasMany('App\Http\Models\MedicalRecord','patient_id','id')
            ->select('id','patient_id','title','medical_status','type','time_from','time_to','result','status','created_at','updated_at')
            ->where('is_deleted', '=' , 0);
    }
    public function consult() {
        return $this->hasMany('App\Http\Models\Consult','patient_id','id')
            ->select('id','patient_id','disease_name','disease_type','symptoms','bathing_habit','sleep','created_at','updated_at')
            ->where('is_deleted', '=' , 0);
    }
    
    public function getUserDataById($id=0) {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        try {
            $arrData = self::select('id','user_id','gender','dob','blood_group','marital_status','height','weight','image_name','image_url','smoking','alcohol','daily_routine_work','diet','occupation','status','created_at','updated_at')
                        ->with('user')
                        ->with('medica_record')
                        ->with('consult')
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

    public function getUserDataByUserId($user_id=0) {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        try {
            $arrData = self::select('id','user_id','gender','dob','blood_group','marital_status','height','weight','image_name','image_url','smoking','alcohol','daily_routine_work','diet','occupation','status','created_at','updated_at')
                        ->with('user')
                        ->where('user_id','=',$user_id)
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

    public function getDataWithPaginate($paginate = 10, $searchKeyword = '') {
        $arrResp = [];
        $arrData = [];
        $status = 0;
        $message = '';
        try {
            $query = self::query();
            $query->select('id','user_id','gender','dob','blood_group','marital_status','status','created_at','updated_at');
            $query->with('user');
            // Search Keyword
            if(!empty($searchKeyword)) {
                $searchKeywordString = "(name LIKE '%$searchKeyword%' OR email LIKE '%$searchKeyword%' OR mobile LIKE '%$searchKeyword%')";
                $query->whereRaw($searchKeywordString);
            }
            $query->where('is_deleted', '=', 0);
            $query->orderBy('created_at', 'desc');
            $arrData = $query->paginate($paginate);            
            // print("<pre>"); print_r($arrData); exit('modal');
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

    public function addPatient() {
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