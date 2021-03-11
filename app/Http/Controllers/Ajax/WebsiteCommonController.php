<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Accessory;
use App\Http\Models\AccessoryCategory;
use App\Http\Models\District;
use App\Http\Models\Location;
use App\Http\Models\ProductPrice;
use App\Http\Models\Post;
use App\Http\Models\PopularTag;
use App\Http\Models\DealerTouchPointMapping;
use Validator, DB;


class WebsiteCommonController extends Controller
{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(Request $request) {
        
        $input = $request->all();
        echo '<pre>'; print_r($input); exit('here');
        
    }
    
    /*
     * @Date    : July 26, 2019
     * @Use     : Set Cookie
     * @Params  : -
     * @Cretaed By : SG
     */
    public function setCookie(Request $request) {
        $arrJson    = array();
        $status     = 0;
        $message    = '';
        
        try {
            // 
            $input = $request->all();
            // echo '<pre>'; print_r($input); exit('here');
            if(!empty($input) && !empty($input['cookie_value'])){
                // 
                $cookie_value = $input['cookie_value'];
                $cookie_name = "gixxer_cup_cookie_policy";
                setcookie($cookie_name, $cookie_value, time() + (86400 * 7), "/"); // 86400 = 1 day
                // 
                $status = 1; 
                $message    = 'Cookie set successfully';
                
            }  else {
                // Throw New Exception
                throw new \Exception('Unable to set cookie, please try again later!');
            }
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        
        $arrJson['status']  = $status;
        $arrJson['message'] = $message;
        
        echo json_encode($arrJson); exit;    
    }
    
}
