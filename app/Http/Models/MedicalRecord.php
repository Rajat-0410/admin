<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'medical_records';
    public $field;

    public function medical_record_image() {
        return $this->hasMany('App\Http\Models\MedicalRecordImage','medical_record_id','id')
            ->select('id','medical_record_id','image_name','image_url','status','created_at','updated_at')
            ->where('is_deleted', '=' , 0);
    }
    
    public function getMedicalDataById($id=0) {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        try {
            $arrData = self::select('id','user_id', 'title','medical_status','type', 'time_from', 'time_to', 'result', 'created_at','updated_at')
                        ->with('medical_record_image')
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
            $query->select('id','user_id', 'title','medical_status','type', 'time_from', 'time_to', 'result', 'updated_at');
            // $query->with('user');
            // Search Keyword
            if(!empty($searchKeyword)) {
                $searchKeywordString = "(title LIKE '%$searchKeyword%' OR medical_status LIKE '%$searchKeyword%')";
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

    public function addMedicalRecord() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $medicalRecordObj = new MedicalRecord();

            $medicalRecordObj->user_id          = $this->field['user_id'];
            $medicalRecordObj->title   	        = $this->field['name'];
            $medicalRecordObj->medical_status  	= $this->field['medical_status'];
            $medicalRecordObj->type             = $this->field['type'];
            $medicalRecordObj->time_from  	    = $this->field['time_from'];
            $medicalRecordObj->time_to          = $this->field['time_to'];
            $medicalRecordObj->result           = $this->field['result'];

            if($medicalRecordObj->save()){
                $message = 'Medical Record addded successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to add Medical Record, please try again later!';
            }
        } catch (\Exception $ex) {
            $status = 0;
            echo $message = $ex->getMessage();
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
            $medicalRecordObj = new MedicalRecord();
            $medicalRecordObj->id           = $this->field['id'];
            $medicalRecordObj->exists       = true;
            if(!empty($this->field['name'])){
                $medicalRecordObj->title = $this->field['name'];
            }
            if(!empty($this->field['medical_status'])){
                $medicalRecordObj->medical_status = $this->field['medical_status'];
            }
            if(!empty($this->field['type'])){
                $medicalRecordObj->type = $this->field['type'];
            }
            if(!empty($this->field['time_from'])){
                $medicalRecordObj->time_from = $this->field['time_from'];
            }
            if(!empty($this->field['time_to'])){
                $medicalRecordObj->time_to = $this->field['time_to'];
            }
            if(!empty($this->field['result'])){
                $medicalRecordObj->result = $this->field['result'];
            }

            if($medicalRecordObj->save()){
                $message = 'Medical Record updated successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to update Medical Record, please try again later!';
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
            $medicalRecordObj = new MedicalRecord();
            $medicalRecordObj->id           = $this->field['id'];
            $medicalRecordObj->exists       = true;
            $medicalRecordObj->is_deleted   = 1;
            if($medicalRecordObj->save()){
                $message = 'Medical Record deleted successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to delete Medical Record, please try again later!';
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