<?php

namespace App\Http\Controllers\PatientManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use App\Http\Models\User;
use App\Http\Models\UserRole;
use App\Http\Models\Patient;
use App\Http\Models\MedicalRecord;
use App\Http\Models\Consult;
use Illuminate\Support\Facades\Hash;
// use App\Http\Models\Module;
// use App\Http\Models\Permission;



use Validator, DB;


class PatientManagementController extends Controller
{
    
    public function __construct() {
        parent::__construct();
        $this->viewData['page_title'] = 'Patient';
    }
    
   /*
     * @Date    : Mar 13, 2021
     * @Use     : Show Patient listing
     * @Params  : -
     * @Cretaed By : Rajat
     */
    public function index(Request $request) {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'All Patient';
        $input = $request->all();
        $keyword = '';
        // $role_id = config('constant.PATIENT');
        if(isset($input['keyword']) && !empty($input['keyword'])){
           $keyword = $input['keyword'];
        }
        // echo '<pre>'; print_r($patient_id);  exit;
       
        $paginate = config('constant.PAGINATE');
        $userObj = new Patient();
        $arrResp = $userObj->getDataWithPaginate($paginate,$keyword);
        $allRecords = $arrResp['data'];
        // echo '<pre>'; print_r($allRecords);  exit('controller');

        $this->viewData['all_records'] = $allRecords;
        $this->viewData['keyword'] = $keyword;
        $this->viewData['no_records_found'] = config('constant.NO_RECORDS_FOUND');
        return view('patient.index',$this->viewData);
    }
    
    public function view($id) {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'View Patient Detail';
        $userData = User::find(base64_decode($id));
        // echo '<pre>'; print_r($userData);  exit('controller');
        $user_id = $userData->id;

        $all_record = [];
        $keyword = '';
        $paginate = 10;

        $patientObj = new Patient();
        $arrPatientResp = $patientObj->getUserDataById($user_id);
        $all_record = $arrPatientResp['data'];
        // echo '<pre>'; print_r($all_record['user']->name);  exit;

        $this->viewData['all_record'] = $all_record;
        $this->viewData['arr_status'] = config('constant.STATUS');
        $this->viewData['no_records_found'] = config('constant.NO_RECORDS_FOUND');
        return view('patient.view',$this->viewData);
    }
    
    public function store(Request $request) {
        
        $input = $request->all();
        // echo '<pre>'; print_r($input);  exit;
		$id = !empty($input['id']) ? $input['id'] : 0;
        // Validation => START
        $checkBox = (isset($input['change_password'])) ? 1 : 0;
        if(!empty($checkBox)) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$id,
				'mobile' => 'required|numeric|digits_between:10,10',
                'password' => 'required',
                'password_confirmation' => 'required|required_with:password|same:password',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$id,
				'mobile' => 'required|numeric|digits_between:10,10',
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
		$userObj->field['mobile'] = $input['mobile'];
		$userObj->field['business_partner_id'] = Session::get('user_data.id');
        $userObj->field['role_id'] = config('constant.EMPLOYEE');
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
            Session::flash('message', "Employee has been $action sucessfully."); 
            Session::flash('alert-class', 'alert-success'); 
            Session::flash('icon-class', 'icon fa fa-check');
            return redirect('admin/employee-management');
        } else {
            // False
            Session::flash('message', 'Unable to save Employee, please try again later!'); 
            Session::flash('alert-class', 'alert-danger'); 
            Session::flash('icon-class', 'icon fa fa-ban');
            return redirect('admin/employee-management/add');
        }
        
    }
    
    public function delete($id) {
        
        $arrResp = [];
        // New Menu Object
        $userObj = new User();
        // Pass Data To Model
        $userObj->field['id'] = base64_decode($id);
        $arrResp = $userObj->deleteUser();
        // print_r($arrResp); exit('sadsa');
        if($arrResp['status']==1){
            // True
            Session::flash('message', "Employee has been deleted sucessfully."); 
            Session::flash('alert-class', 'alert-success'); 
            Session::flash('icon-class', 'icon fa fa-check');
            return redirect('admin/employee-management');
        } else {
            // False
            Session::flash('message', 'Unable to delete Employee, please try again later!'); 
            Session::flash('alert-class', 'alert-danger'); 
            Session::flash('icon-class', 'icon fa fa-ban');
            return redirect('admin/employee-management');
        }
        
    }

        
}
