<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;

use App\Http\Models\User;

use Validator, DB;

class UserController extends Controller
{
    
    // public function __construct() {
    //     parent::__construct();
    //     $this->viewData['page_title'] = 'User';
    // }
    
    /*
     * @Date    : Mar 13, 2021
     * @Use     : Show user Role
     * @Params  : -
     * @Cretaed By : Rajat Singh
     */
    public function index(Request $request) {
        // Set Sub Page Title
        $this->viewData['page_sub_title'] = 'All User';
        $input = $request->all();
        $getId=0;
        $keyword = '';
        if(isset($input['id']) && !empty($input['id'])){
           $getId = $input['id'];
        }
        if(isset($input['keyword']) && !empty($input['keyword'])){
           $keyword = $input['keyword'];
        }
        // 
        $paginate = config('constant.PAGINATE');
        $userRoleObj = new UserRole();
        $arrResp = $userRoleObj->getDataWithPaginate($paginate,$keyword);
        // print("<pre>"); print_r($arrResp); exit('in Controller');
        $allRecords = $arrResp['data'];
        $this->viewData['all_records'] = $allRecords;
        $this->viewData['keyword'] = $keyword;
        $this->viewData['no_records_found'] = config('constant.NO_RECORDS_FOUND');
        // print("<pre>"); print_r($this->viewData); exit('sadas');

        $this->viewData['arr_status'] = config('constant.STATUS');
        
        $btn_name = 'Add';
        $parent_id = '';
        $name = '';
        $slug = '';
        $description = '';
        $status = 1;
        if(!empty($getId)){
            // echo $getId; exit('here');
            $userRole = UserRole::find(base64_decode($getId));
            $getId = $userRole->id;
            $name = $userRole->role;
            $status = $userRole->status;
            $btn_name = 'Update';
        }
        $this->viewData['get_id']       = $getId;
        $this->viewData['name']         = $name;
        $this->viewData['status']       = $status;
        $this->viewData['btn_name']     = $btn_name;
        // echo '<pre>'; print_r($this->viewData); exit;
        return view('user-role.index',$this->viewData);
    }

    public function login(Request $request)
    {
        try {
            echo '<pre>'; print('hello'); exit;

            $valid = Validator::make($request->all(), [
                'mobile' => 'required|regex:/[0-9]{9}/|max:10',
            ]);

            if ($valid->fails()) {
                return response()->json([
                    'error' => $valid->errors(),
                ],400);
            }
            $user = new User();
            $mobile = $request->mobile;
            
            $db_all = User::select('mobile')->where('mobile', '=', $request->mobile)->first();
            if ($db_all == null)
            {
                $user->mobile = $request->mobile;
                $otp = rand(100000,999999);
                $user->otp = $otp;
                $user->ip = $request->ip();

                // Message details
                // $numbers = '91'.$user->mobile;
                // $sender = urlencode('TXTLCL');
                // $message = rawurlencode('<#> Your Homeodocs OTP is : '.$otp. ' vNsoI+IFzlu');
                
                // // Prepare data for POST request
                // $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
                
                // // Send the POST request with cURL
                // $ch = curl_init('https://api.textlocal.in/send/');
                // curl_setopt($ch, CURLOPT_POST, true);
                // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                // $response = curl_exec($ch);
                // curl_close($ch);

                $user->save();
                return response()->json(
                [
                    'result' => 'success',
                    'data' => [
                        'id' => $user->id,
                        'otp' => $user->otp,
                        'code' => 'new user',
                    ],
                ],200);
            }
            else
            {
                $mobile = $db_all->mobile;
                $db_phone_all = User::select('*')->where('mobile', '=', $request->mobile)->first();
                $otp = rand(100000,999999);
                $db_phone_all->otp = $otp;
                $db_phone_all->ip = $request->ip(); 

        
                // // Message details
                // $numbers = '91'.$mobile;
                // $sender = urlencode('TXTLCL');
                // $message = rawurlencode('<#> Your Homeodocs OTP is : '.$otp. ' vNsoI+IFzlu');
                
                // // Prepare data for POST request
                // $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
                
                // // Send the POST request with cURL
                // $ch = curl_init('https://api.textlocal.in/send/');
                // curl_setopt($ch, CURLOPT_POST, true);
                // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                // $response = curl_exec($ch);
                // curl_close($ch);

                $db_phone_all->save();
                return response()->json(
                [
                    'result' => 'success',
                    'data' => [
                        'id' => $db_phone_all->id,
                        'otp' => $otp,
                        'code' => 'old user',
                    ],
                ],200);
            }
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
            Log::info('LOGINERROR: '.$message);
            return response()->json([
                'result' => 'error',
                // 'data' => array(),
                'message' => 'SERVER_ERROR'
            ],400);
        }	
    }
   
    public function add() {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'Add New User';
        
        // New AccessoryCategory Object
        $userRoleObj = new UserRole();
        $roleArr = $userRoleObj->getUserRole();
        $this->viewData['roleArr'] = $roleArr['data'];
        $this->viewData['arr_status'] = config('constant.STATUS');
        // echo '<pre>'; print_r($this->viewData); exit;
        return view('user.add',$this->viewData);
    }
  
    public function edit($id) {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'Edit User';
        $user = User::find(base64_decode($id));
        // echo '<pre>'; print_r($user); exit;
        $this->viewData['id'] = $user->id;
        $this->viewData['name'] = $user->name;
        $this->viewData['role_id'] = $user->role_id;
        $this->viewData['email'] = $user->email;
        $this->viewData['status'] = $user->status;
        // echo '<pre>'; print_r($this->viewData); exit;
        // Get Role
        $userRoleObj = new UserRole();
        $roleArr = $userRoleObj->getUserRole();
        $this->viewData['roleArr'] = $roleArr['data'];
        $this->viewData['arr_status'] = config('constant.STATUS');
        
        return view('user.edit',$this->viewData);
    }
    
    public function store(Request $request) {
        
        $input = $request->all();
        // echo '<pre>'; print_r($input); exit;
        // Validation => START
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        // Validation => END
        // Initialize Variables
        $arrResp = [];
        $action = 'added';
        // Action
        $isUpdate = (isset($input['id']) && !empty($input['id'])) ? true:false;
        // New Menu Object
        $userRoleObj = new UserRole();
        // Pass Data To Model
        if($isUpdate){
            // If Update True Pass Data To Model
            $userRoleObj->field['id'] = $input['id'];
            $action = 'updated';
        }
               
        $userRoleObj->field['name'] = $input['name'];
        $userRoleObj->field['status'] = $input['status'];
        
        if($isUpdate){
            // If Update
            $arrResp = $userRoleObj->updateUserRole();
        } else {
            // If Add
            $arrResp = $userRoleObj->addUserRole();
        }
        
        if($arrResp['status']==1){
            // True
            Session::flash('message', "User role has been $action sucessfully."); 
            Session::flash('alert-class', 'alert-success'); 
            Session::flash('icon-class', 'icon fa fa-check');
            return redirect('admin/user-role');
        } else {
            // False
            Session::flash('message', 'Unabel to save user role, please try again later!'); 
            Session::flash('alert-class', 'alert-danger'); 
            Session::flash('icon-class', 'icon fa fa-ban');
            return redirect('admin/user-role');
        }
        
    }
   
    public function delete($id) {
        
        $arrResp = [];
        // New Category Object
        $userRoleObj = new UserRole();
        // Pass Data To Model
        $userRoleObj->field['id'] = base64_decode($id);
        $arrResp = $userRoleObj->deleteUserRole();
        // print_r($arrResp); exit('sadsa');
        if($arrResp['status']==1){
            // True
            Session::flash('message', "User role has been deleted sucessfully."); 
            Session::flash('alert-class', 'alert-success'); 
            Session::flash('icon-class', 'icon fa fa-check');
            return redirect('admin/user-role');
        } else {
            // False
            Session::flash('message', 'Unabel to delete user role, please try again later!'); 
            Session::flash('alert-class', 'alert-danger'); 
            Session::flash('icon-class', 'icon fa fa-ban');
            return redirect('admin/user-role');
        }
        
    }
    
    
}
