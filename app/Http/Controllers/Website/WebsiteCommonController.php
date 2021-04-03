<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use App\Http\Models\State;
use App\Http\Models\City;
use App\Http\Models\ProfessionType;

use Validator, DB;

class WebsiteCommonController extends Controller
{
    public function index(Request $request) {
        $input = $request->all();
        echo '<pre>'; print_r($input); exit('here');
    }

    /*
     * @Date        : Dec 07, 2020
     * @Use         : 
     * @Params      : 
     * @Cretaed By  : Rajat Singh
     */
    public function termCondition() {
        return view('website.home.term&condition');
    }

    /*
     * @Date        : Dec 07, 2020
     * @Use         : 
     * @Params      : 
     * @Cretaed By  : Rajat Singh
     */
    public function privacyPolicy() {
        return view('website.home.privacypolicy');
    }
    
    /*
     * @Date    : Dec 07, 2020
     * @Use     : 
     * @Params  : -
     * @Cretaed By : Rajat Singh
     */
    public function getStates() {
        $arrJson    = array();
        $status     = 0;
        $message    = '';
        $arrData    = [];
        try {
                $state = new State();
                $arrResp = $state->getStateList();
                // echo '<pre>'; print_r($arrResp['data']); exit('controler state');
                if($arrResp['status']==1){
                    $status = $arrResp['status'];
                    $message = $arrResp['message'];
                    if($arrResp['data']){
                        foreach ($arrResp['data'] as $key => $value) {
                            $arrData[] = array(
                                            'state_id' => $value['id'],
                                            'state_name' => $value['name']
                                        );
                        }
                    }
                } else {
                    throw new \Exception('Unable to get data, please try again!');
                }
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        
        $arrJson['status']  = $status;
        $arrJson['message'] = $message;
        $arrJson['data']    = $arrData;
        
        echo json_encode($arrJson); exit;         
    }

    /*
     * @Date    : Dec 07, 2020
     * @Use     : 
     * @Params  : -
     * @Cretaed By : Rajat Singh
     */
    public function getCity(Request $request) {
        
        $arrJson    = array();
        $status     = 0;
        $message    = '';
        $arrData    = [];
        try {
            // 
            $input = $request->all();
            if(!empty($input)){
                // echo '<pre>'; print_r($input); exit('contorller');
                $state_id  = $input['state_id'];
                if(!empty($state_id)){
                    // echo $state_id; exit('here');
                    $city = new City();
                    $arrResp = $city->getCityList($state_id);
                    // echo '<pre>'; print_r($arrResp); exit('controller city');
                    if($arrResp['status']==1){
                        $status = $arrResp['status'];
                        $message = $arrResp['message'];
                        if($arrResp['data']){
                            foreach ($arrResp['data'] as $key => $value) {
                                $arrData[] = array(
                                                'city_id' => $key,
                                                'city_name' => $value
                                            );
                            }
                        }
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
        $arrJson['data']    = $arrData;
        
        echo json_encode($arrJson); exit;         
    }
    
    public function sendOTPtoUser(Request $request) {
        $mobile = $request->input('mobile_number');
		if(config('constant.OTP_BYPASS') === true && in_array($mobile, config('constant.OTP_BYPASS_MOBILE'))) {
			$otp = 222222;
			Session::put('otp', $otp);
		} else {
			$otp = rand(100000, 150040);
			Session::put('otp', $otp);
			$message = "Your one time password is " . trim($otp); // 123"Hi, Your OTP is " . $otp;
			$this->sendTextMessage(trim($mobile), $message); // Use to generate and send OTP
		}
    }
    
}