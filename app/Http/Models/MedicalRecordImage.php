<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecordImage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'medical_record_images';
    public $field;
    
    public function getMedicalRecordImageDataById($id=0) {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        try {
            $arrData = self::select('id','medical_record_id', 'image_name', 'image_url' , 'updated_at')
                        ->where('id','=',$id)
                        ->where('status','=',1)
                        ->where('is_deleted','=',0)
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

    public function getDataWithPaginate($paginate = 10, $searchKeyword = '',$patient_id = 0) {
        $arrResp = [];
        $arrData = [];
        $status = 0;
        $message = '';
        try {
            $query = self::query();
            $query->select('id','medical_record_id', 'image_name', 'image_url' , 'updated_at');
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

    public function addMedicalRecord() {
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
    
    public function updateMedicalRecord() {
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

    public function deleteMedicalRecord() {
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