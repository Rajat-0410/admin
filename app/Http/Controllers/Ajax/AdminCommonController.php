<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use Validator, DB;

class AdminCommonController extends Controller
{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(Request $request) {
        
        $input = $request->all();
        echo '<pre>'; print_r($input); exit('here');
        
    }
    
    /*
     * @Date    : Feb 11, 2019
     * @Use     : Show menu listing
     * @Params  : -
     * @Cretaed By : SG
     */
    public function change_status(Request $request) {
        
        $arrJson    = array();
        $status     = 0;
        $message    = '';
        $status_text = '';
        try {
            // 
            $input = $request->all();
            if(!empty($input)){
                // echo '<pre>'; print_r($input); exit('here');
                $getId  = $status = $model= NULL;
                $getId  = $input['req_id'];
                $status = $input['req_status'];
                $model  = $input['req_model'];                
                if(!empty($getId) && !empty($model)){
                    $id = base64_decode($getId);
                    // echo $id; exit('here');
                    $className = 'App\\Http\\Models\\' . $model;
                    // var_dump(class_exists($model)); exit('her');
                    if (class_exists($className)){
                        $model = new $className;
                        $model->id = $id;
                        $model->exists = true;
                        $model->status = $status;
                        $action = ($status == 1)  ? 'Active' : 'Inactive';
                        $messageText = ($status == 1)  ? 'activated' : 'inactivated';
                        if($model->save()){
                            $status = 1;
                            $status_text = $action;
                            $message = "Record has been ".$messageText." successfully.";
                        } else {
                            throw new \Exception('Unable to change status, please try again!');
                        }
                    } else {
                        // Throw New Exception
                        throw new \Exception('Missing params, please try again!');
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
        
        $arrJson['status'] = $status;
        $arrJson['message'] = $message;
        $arrJson['status_text'] = $status_text;
        
        echo json_encode($arrJson); exit;
    }
    
    /*
     * @Date    : Feb 11, 2019
     * @Use     : Show menu listing
     * @Params  : -
     * @Cretaed By : SG
     */
    public function getRounds(Request $request) {
        
        $arrJson    = array();
        $status     = 0;
        $message    = '';
        $arrData    = [];
        try {
            // 
            $input = $request->all();
            if(!empty($input)){
                // echo '<pre>'; print_r($input); exit('here');
                $resultYearId  = $input['result_year_id'];
                if(!empty($resultYearId)){
                    // echo $resultYearId; exit('here');
                    $roundObj = new \App\Http\Models\Round;
                    $arrResp = $roundObj->getRoundsByYearId($resultYearId);
                    // echo '<pre>'; print_r($arrResp); exit('here');
                    if($arrResp['status']==1){
                        $status = $arrResp['status'];
                        $message = $arrResp['message'];
                        if($arrResp['data']){
                            foreach ($arrResp['data'] as $key => $value) {
                                $arrData[] = array(
                                                'round_id' => $key,
                                                'round_name' => $value
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
    
}
