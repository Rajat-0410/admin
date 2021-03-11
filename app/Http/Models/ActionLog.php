<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ActionLog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'action_logs';
    public $field;
    
    public function user() {
        return $this->belongsTo('App\Http\Models\User','user_id','id')
            ->select('id','role_id','name');
    }
    
    public function getDataWithPaginate($controller='',$recordId=0) {
        $arrResp = [];
        $arrData = [];
        $status = 0;
        $message = '';
        try {
            // 
            $paginate = config('constant.PAGINATE');
            $query = self::query();
            // $query->select('id','created_at','updated_at');
            $query->with('user');
            $query->where('controller','=',$controller);
            if(!empty($recordId)){
                $query->where('record_id','=',$recordId);
            }
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
    
    public function addLog() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            // 
            $actionLogObj = new ActionLog();
            $actionLogObj->record_id = $this->field['record_id'];
            $actionLogObj->user_id = $this->field['user_id'];
            $actionLogObj->controller = $this->field['controller'];
            $actionLogObj->action = $this->field['action'];
            if($actionLogObj->save()){
                $message = 'Log added successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to add log, please try again later!';
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