<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB, Request, Auth;

class GeneralSettings extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'general_settings';
    public $field;
    
    public static function getGeneralSettingsByGroup($group='') {
        $arrData    = [];
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $arrData = self::query()->select('key','value')
                        ->where('group','=',$group)
                        ->where('status','=',1)
                        ->where('is_deleted','=',0)
                        ->get();
            // print("<pre>"); print_r($arrData); exit('sadas');
            $status = 1;
            $message = 'success';
            
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        $arrResp['data'] = $arrData;
        
        return $arrResp;
    }
    
    public static function getGeneralSettingValue($group='',$key='') {
        $value = '';
        try {
            $arrData = self::query()->select('value')
                        ->where('group','=',$group)
                        ->where('key','=',$key)
                        ->where('status','=',1)
                        ->where('is_deleted','=',0)
                        ->first();
            // print("<pre>"); print_r($arrData); exit('sadas');
            if(!empty($arrData)){
                $value = $arrData->value;
            }
            
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }       
        return $value;
    }
    
    public function updateSocialIconCount() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {

            $generalSettingsObj = new GeneralSettings();
            $generalSettingsObj->exists       = true;
            $generalSettingsObj->id           = $this->field['id'];
            $generalSettingsObj->value        = $this->field['value'];
            if($generalSettingsObj->save()){
                $message = 'Social icon count update successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to update social icon count, please try againa later!';
            }
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }
    
    public function updateSettingValue($group='',$key='',$arrValues=[]) {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            
            $generalSettingsObj = new GeneralSettings();
            $isUpdated = $generalSettingsObj->where('group', $group)
                            ->where('key', $key)
                            ->update($arrValues);
            if($isUpdated){
                $message = 'Settings updated successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to update settings, please try againa later!';
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