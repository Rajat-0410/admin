<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Consult extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'consults';
    public $field;

    public function patient() {
        return $this->belongsTo('App\Http\Models\Patient','user_id')
            ->select('id','user_id','gender','dob','blood_group','marital_status','height','weight','image_name','image_url','smoking','alcohol','daily_routine_work','diet','occupation','status','created_at','updated_at')
            ->where('is_deleted', '=' , 0);
    }

    public function consult_image() {
        return $this->hasMany('App\Http\Models\ConsultImage','consult_id','id')
            ->select('id','consult_id','image_name','image_url','size','status','created_at','updated_at')
            ->where('is_deleted', '=' , 0);
    }
    
    public function getDataById($id=0, $view_with='') {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        try {
            $query = self::query();
            $query->select('id','user_id', 'disease_name','disease_type','symptoms', 'bathing_habit', 'sleep', 'dreams', 'menstrual_history', 'obstetric_history', 'sexual_history', 'family_history', 'blood_pressure', 'pulse_rate', 'temprature', 'appetite', 'thirst', 'addiction', 'thermalReaction', 'perspiration', 'urine', 'stool', 'desire', 'created_at', 'updated_at');
            // Search Keyword
            if(empty($view_with)) {
                $query->with('patient');
            }
            $query->with('consult_image');
            $query->where('id', '=', $id);
            $query->where('status', '=', 1);
            $query->where('is_deleted', '=', 0);
            $query->orderBy('created_at', 'desc');
            $arrData = $query->first();  

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

    public function getDataByUserId($user_id=0) {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        try {
            $arrData = self::select('id','user_id', 'disease_name','disease_type','symptoms', 'bathing_habit', 'sleep', 'dreams', 'menstrual_history', 'obstetric_history', 'sexual_history', 'family_history', 'blood_pressure', 'pulse_rate', 'temprature', 'appetite', 'thirst', 'addiction', 'thermalReaction', 'perspiration', 'urine', 'stool', 'desire', 'created_at', 'updated_at')
                        ->where('user_id','=',$user_id)
                        ->where('status','=',1)
                        ->where('is_deleted','=',0)
                        ->get(); 
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
            $query->select('id', 'patient_id', 'disease_name','disease_type', 'created_at', 'updated_at');
            // $query->with('consult_image');
            // Search Keyword
            if(!empty($searchKeyword)) {
                $searchKeywordString = "(disease_name LIKE '%$searchKeyword%')";
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

    public function addConsult() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $consultObj = new Consult();

            $consultObj->user_id   	    = $this->field['user_id'];
            $consultObj->disease_name   = $this->field['disease_name'];
            $consultObj->disease_type   = $this->field['disease_type'];
            if(!empty($this->field['symptoms'])){
                $consultObj->symptoms = $this->field['symptoms'];
            }
            if(!empty($this->field['bathing_habit'])){
                $consultObj->bathing_habit = $this->field['bathing_habit'];
            }
            if(!empty($this->field['sleep'])){
                $consultObj->sleep = $this->field['sleep'];
            }
            if(!empty($this->field['dreams'])){
                $consultObj->dreams = $this->field['dreams'];
            }
            if(!empty($this->field['menstrual_history'])){
                $consultObj->menstrual_history = $this->field['menstrual_history'];
            }
            if(!empty($this->field['obstetric_history'])){
                $consultObj->obstetric_history = $this->field['obstetric_history'];
            }
            if(!empty($this->field['sexual_history'])){
                $consultObj->sexual_history = $this->field['sexual_history'];
            }
            if(!empty($this->field['family_history'])){
                $consultObj->family_history = $this->field['family_history'];
            }
            if(!empty($this->field['blood_pressure'])){
                $consultObj->blood_pressure = $this->field['blood_pressure'];
            }
            if(!empty($this->field['pulse_rate'])){
                $consultObj->pulse_rate = $this->field['pulse_rate'];
            }
            if(!empty($this->field['temprature'])){
                $consultObj->temprature = $this->field['temprature'];
            }
            if(!empty($this->field['appetite'])){
                $consultObj->appetite = $this->field['appetite'];
            }
            if(!empty($this->field['thirst'])){
                $consultObj->thirst = $this->field['thirst'];
            }
            if(!empty($this->field['addiction'])){
                $consultObj->addiction = $this->field['addiction'];
            }
            if(!empty($this->field['thermalReaction'])){
                $consultObj->thermalReaction = $this->field['thermalReaction'];
            }
            if(!empty($this->field['perspiration'])){
                $consultObj->perspiration = $this->field['perspiration'];
            }
            if(!empty($this->field['urine'])){
                $consultObj->urine = $this->field['urine'];
            }
            if(!empty($this->field['stool'])){
                $consultObj->stool = $this->field['stool'];
            }
            if(!empty($this->field['desire'])){
                $consultObj->desire = $this->field['desire'];
            }

            if($consultObj->save()){
                $message = 'Consult addded successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to add Consult, please try again later!';
            }
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }
    
    public function updateConsult() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $consultObj = new Consult();
            $consultObj->id           	= $this->field['id'];
            $consultObj->exists       	= true;
            if(!empty($this->field['disease_name'])){
                $consultObj->disease_name = $this->field['disease_name'];
            }
            if(!empty($this->field['disease_type'])){
                $consultObj->disease_type = $this->field['disease_type'];
            }
            if(!empty($this->field['symptoms'])){
                $consultObj->symptoms = $this->field['symptoms'];
            }
            if(!empty($this->field['bathing_habit'])){
                $consultObj->bathing_habit = $this->field['bathing_habit'];
            }
            if(!empty($this->field['sleep'])){
                $consultObj->sleep = $this->field['sleep'];
            }
            if(!empty($this->field['dreams'])){
                $consultObj->dreams = $this->field['dreams'];
            }
            if(!empty($this->field['menstrual_history'])){
                $consultObj->menstrual_history = $this->field['menstrual_history'];
            }
            if(!empty($this->field['obstetric_history'])){
                $consultObj->obstetric_history = $this->field['obstetric_history'];
            }
            if(!empty($this->field['sexual_history'])){
                $consultObj->sexual_history = $this->field['sexual_history'];
            }
            if(!empty($this->field['family_history'])){
                $consultObj->family_history = $this->field['family_history'];
            }
            if(!empty($this->field['blood_pressure'])){
                $consultObj->blood_pressure = $this->field['blood_pressure'];
            }
            if(!empty($this->field['pulse_rate'])){
                $consultObj->pulse_rate = $this->field['pulse_rate'];
            }
            if(!empty($this->field['temprature'])){
                $consultObj->temprature = $this->field['temprature'];
            }
            if(!empty($this->field['appetite'])){
                $consultObj->appetite = $this->field['appetite'];
            }
            if(!empty($this->field['thirst'])){
                $consultObj->thirst = $this->field['thirst'];
            }
            if(!empty($this->field['addiction'])){
                $consultObj->addiction = $this->field['addiction'];
            }
            if(!empty($this->field['thermalReaction'])){
                $consultObj->thermalReaction = $this->field['thermalReaction'];
            }
            if(!empty($this->field['perspiration'])){
                $consultObj->perspiration = $this->field['perspiration'];
            }
            if(!empty($this->field['urine'])){
                $consultObj->urine = $this->field['urine'];
            }
            if(!empty($this->field['stool'])){
                $consultObj->stool = $this->field['stool'];
            }
            if(!empty($this->field['desire'])){
                $consultObj->desire = $this->field['desire'];
            }

            if($consultObj->save()){
                $message = 'Consult updated successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to update Consult, please try again later!';
            }
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }

    public function deleteConsult() {
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