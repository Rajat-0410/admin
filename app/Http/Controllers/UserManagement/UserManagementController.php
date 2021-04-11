<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use App\Http\Models\User;
use App\Http\Models\Doctor;
use App\Http\Models\UserRole;
use Illuminate\Support\Facades\Hash;
// use App\Http\Models\Module;
// use App\Http\Models\Permission;



use Validator, DB;


class UserManagementController extends Controller
{
    
    public function __construct() {
        parent::__construct();
        $this->viewData['page_title'] = 'User';
    }
    
   /*
     * @Date    : May 15, 2019
     * @Use     : Show user listing
     * @Params  : -
     * @Cretaed By : SD
     */
    public function index(Request $request) {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'All User';
        $input = $request->all();
        $keyword = '';
        $role_id = 0;
        if(isset($input['keyword']) && !empty($input['keyword'])){
           $keyword = $input['keyword'];
        }
        if(isset($input['role_id']) && !empty($input['role_id'])){
           $role_id = $input['role_id'];
        }
        $paginate = config('constant.PAGINATE');
        $userObj = new User();
        $arrResp = $userObj->getDataWithPaginate($paginate,$keyword,$role_id);
        $allRecords = $arrResp['data'];
        // print("<pre>"); print_r($allRecords); exit('In Controller');

        $userRoleObj = new UserRole();
        $roleArr = $userRoleObj->getUserRole();
        $this->viewData['roleArr'] = $roleArr['data'];
        $this->viewData['all_records'] = $allRecords;
        $this->viewData['keyword'] = $keyword;
        $this->viewData['role_id'] = $role_id;
        $this->viewData['no_records_found'] = config('constant.NO_RECORDS_FOUND');
        // print("<pre>"); print_r($this->viewData); exit('sadassdadsdasd');
        return view('user.index',$this->viewData);
    }
    
   
    public function add() {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'Add New User';
        
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
        // echo '<pre>'; print_r($input);  exit;
        // Validation => START
        $checkBox = (isset($input['change_password'])) ? 1 : 0;
        if(!empty($checkBox)) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'password_confirmation' => 'required|required_with:password|same:password',
                'role_id' => 'required'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'role_id' => 'required'
            ]);
        }
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
        $userObj = new User();
        // Pass Data To Model
        if($isUpdate){
            // If Update True Pass Data To Model
            $userObj->field['id'] = $input['id'];
            $action = 'updated';
        }
        
        $userObj->field['name'] = $input['name'];
        $userObj->field['email'] = $input['email'];
        $userObj->field['role_id'] = $input['role_id'];
        $userObj->field['status'] = $input['status'];
        if(isset($input['password']) && !empty($input['password'])) {
            $userObj->field['password'] = Hash::make($input['password']);
        }
        
        if($isUpdate){
            // If Update
            $arrResp = $userObj->updateUser();
        } else {
            // If Add
            $arrResp = $userObj->addUser();
        }
        
        if($arrResp['status']==1){
            // True
            Session::flash('message', "User has been $action sucessfully."); 
            Session::flash('alert-class', 'alert-success'); 
            Session::flash('icon-class', 'icon fa fa-check');
            return redirect('admin/user-management');
        } else {
            // False
            Session::flash('message', 'Unabel to save User, please try again later!'); 
            Session::flash('alert-class', 'alert-danger'); 
            Session::flash('icon-class', 'icon fa fa-ban');
            return redirect('admin/user-management/add');
        }
        
    }
    
    public function delete($id) {
        
        $arrResp = [];
        // New Menu Object
        $userObj = new User();
        // Pass Data To Model
        $userObj->field['id'] = $id;
        $arrResp = $userObj->deleteUser();
        // print_r($arrResp); exit('sadsa');
        if($arrResp['status']==1){
            // True
            Session::flash('message', "User has been deleted sucessfully."); 
            Session::flash('alert-class', 'alert-success'); 
            Session::flash('icon-class', 'icon fa fa-check');
            return redirect('admin/user-management');
        } else {
            // False
            Session::flash('message', 'Unabel to delete user, please try again later!'); 
            Session::flash('alert-class', 'alert-danger'); 
            Session::flash('icon-class', 'icon fa fa-ban');
            return redirect('admin/user-management');
        }
        
    }

    public function profile() {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'Profile';
        $user = auth()->user();
        $doctorObj = new Doctor();
        $doctorData = $doctorObj->getDoctorDataByUserId($user->id);
        $doctorData = $doctorData['data'];
        // echo '<pre>'; print_r($doctorData); exit('controller');
        
        $this->viewData['id'] = $user->id;
        $this->viewData['name'] = $user->name;
        $this->viewData['email'] = $user->email;
        $this->viewData['mobile'] = $user->mobile;
        $this->viewData['address'] = $user->address;
        $this->viewData['father_husband_name'] = $doctorData['father_husband_name'];
        $this->viewData['spouse_name'] = $doctorData['spouse_name'];
        $this->viewData['spouse_mobile'] = $doctorData['spouse_mobile'];
        // echo '<pre>'; print_r($this->viewData); exit;
        
        return view('user.profile.edit',$this->viewData);
    }  
    
    public function profileStore(Request $request) {
        
        $input = $request->all();
        // echo '<pre>'; print_r($input);  exit;
        // Validation => START
        $checkBox = (isset($input['change_password'])) ? 1 : 0;
        if(!empty($checkBox)) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'password_confirmation' => 'required|required_with:password|same:password',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
            ]);
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Validation => END

        $userObj = new User();
        $userObj->field['name'] = $input['name'];
        $userObj->field['email'] = $input['email'];
        $userObj->field['mobile'] = $input['email'];
        if(isset($input['password']) && !empty($input['password'])) {
            $userObj->field['password'] = Hash::make($input['password']);
        }
        $arrResp = $userObj->updateUser();

        if($arrResp['status']==1){
            // True
            Session::flash('message', "User has been $action sucessfully."); 
            Session::flash('alert-class', 'alert-success'); 
            Session::flash('icon-class', 'icon fa fa-check');
            return redirect('admin/user-management');
        } else {
            // False
            Session::flash('message', 'Unabel to save User, please try again later!'); 
            Session::flash('alert-class', 'alert-danger'); 
            Session::flash('icon-class', 'icon fa fa-ban');
            return redirect('admin/user-management/add');
        }
        
    }
}
