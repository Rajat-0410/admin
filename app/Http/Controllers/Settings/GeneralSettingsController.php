<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use App\Http\Models\GeneralSettings;
use Validator, DB;

class GeneralSettingsController extends Controller
{
    
    public function __construct() {
        parent::__construct();
        $this->viewData['page_title'] = 'General Settings';
    }
    
    /*
     * @Date    : May 14, 2019
     * @Use     : 
     * @Params  : -
     * @Cretaed By : SD
     */
    public function index() {
        
        // Set Page Title
        $this->viewData['page_sub_title'] = 'Manage General Settings';
        
        $generalSettingsObj = new GeneralSettings();
        $arrGeneralSettings = $generalSettingsObj->getGeneralSettingsByGroup($group='live-stream');
        // echo '<pre>'; print_r($arrGeneralSettings); exit('here');
        $this->viewData['arr_general_settings'] = $arrGeneralSettings['data'];
        
        return view('settings.general-settings.index',$this->viewData);
    }
    
    public function changeSettings(Request $request) {
        
        $arrJson    = array();
        $status     = 0;
        $message    = '';
        $arrData    = [];
        try {
            // 
            $input = $request->all();
            if(!empty($input)){
                // echo '<pre>'; print_r($input); exit('here');
                $group  = $input['group'];
                $key    = $input['key'];
                $value  = $input['value'];
                if(!empty($group) && !empty($key)){
                    // echo $value; exit('here');
                    $generalSettingsObj = new GeneralSettings();
                    $arrValues = ['value' => $value];
                    $arrResp = $generalSettingsObj->updateSettingValue($group,$key,$arrValues);
                    // echo '<pre>'; print_r($arrResp); exit('update');
                    
                    if($arrResp['status']==1){
                        $status = $arrResp['status'];
                        $message = $arrResp['message'];
                    } else {
                        throw new \Exception('Unable to get data, please try again!');
                    }
                }else{
                    // Throw New Exception
                    throw new \Exception('Missing params, please try again!');
                }
            }  else {
                // Throw New Exception
                throw new \Exception('Missing params, please try again!');
            }
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        
        $arrJson['status']  = $status;
        $arrJson['message'] = $message;
//        $arrJson['data']    = $arrData;
        
        echo json_encode($arrJson); exit;    
        
    }
    
    
}
