<?php

namespace App\Http\Controllers\ConsultManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Http\Models\Consult;
use App\Http\Models\User;

use Validator, DB;


class ConsultManagementController extends Controller
{
    
    public function __construct() {
        parent::__construct();
        $this->viewData['page_title'] = 'Consult';
    }
    
   /*
     * @Date    : Mar 13, 2021
     * @Use     : Show Consult listing
     * @Params  : -
     * @Cretaed By : Rajat
     */
    public function index($id, Request $request) {
        // Set Page Title
        $patient_id = base64_decode($id);
        $this->viewData['page_sub_title'] = 'All Consult';
        $input = $request->all();
        $keyword = '';
        $role_id = config('constant.PATIENT');
        if(isset($input['keyword']) && !empty($input['keyword'])){
           $keyword = $input['keyword'];
        }
       
        $paginate = config('constant.PAGINATE');
        $consultObj = new Consult();
        $arrResp = $consultObj->getDataById($patient_id);
        // echo '<pre>'; print_r($arrResp);  exit('controller');
        $allRecords = $arrResp['data'];

        $this->viewData['all_records'] = $allRecords;
        $this->viewData['keyword'] = $keyword;
        $this->viewData['no_records_found'] = config('constant.NO_RECORDS_FOUND');
        return view('patient.index',$this->viewData);
    }

    public function allConsultUser(Request $request)
    {
        try{
            $token = $request->header()['token'];
            $user = User::where('api_token', $token)->firstorfail();
            $user_id = $user->id;
            $consultObj = new Consult();
            $arrResp = $consultObj->getDataByUserId($user_id);
            $allRecords = $arrResp['data'];
            return response()->json([
                'result' => 'success',
                'data' => $allRecords,
            ], 200);
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
            return response()->json([
                'result' => 'error',
                'message' => 'SERVER_ERROR'
            ],400);
        }
    }

    public function singleConsultUser($id, Request $request)
    {
        try{
            $token = $request->header()['token'];
            $user = User::where('api_token', $token)->firstorfail();
            $user_id = $user->id;

            $view_with = 'yes';
            $consultObj = new Consult();
            $arrResp = $consultObj->getDataById($id, $view_with);
            $allRecords = $arrResp['data'];
            return response()->json([
                'result' => 'success',
                'data' => $allRecords,
            ], 200);
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
            return response()->json([
                'result' => 'error',
                'message' => 'SERVER_ERROR'
            ],400);
        }
    }
    
    public function view($id) {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'View Patient Detail';
        $consult_id = base64_decode($id);
        
        $all_record = [];
        $keyword = '';
        $paginate = 10;
        $arrMedicalResp = [];
        $arrConsultResp = [];
        
        $consultObj = new Consult();
        $consultData = $consultObj->getDataById($consult_id);
        // $consultData = $consultData['data'];
        $all_record['arrConsultData'] = $consultData['data'];
        // echo '<pre>'; print_r($consultData); exit('controller');

        $user_id = $consultData['data']['patient']->user_id;
        $userObj = new User();
        $arrUserResp = $userObj->getUserDataById($user_id);
        $all_record['arrUserData'] = $arrUserResp['data'];
        // echo '<pre>'; print_r($arrUserResp['data']); exit('controller');

        $this->viewData['all_record'] = $all_record;
        $this->viewData['no_records_found'] = config('constant.NO_RECORDS_FOUND');
        return view('patient.consult.view',$this->viewData);
    }
    
    public function store(Request $request) {
        try{
            $token = $request->header()['token'];
            $user = User::where('api_token', $token)->firstorfail();
            $user_id = $user->id;

            $input = $request->all();
            // echo '<pre>'; print_r($input);  exit;
            $id = !empty($input['id']) ? $input['id'] : 0;
            // Validation => START
            $checkId = (isset($input['id'])) ? 1 : 0;
            if(empty($checkId)) {
                $messages = [
                    'disease_name.required' => 'DISEASE_NAME_REQUIRED',
                    'disease_type.required' => 'DISEASE_TYPE_REQUIRED',
                    'symptoms.required' => 'SYMPTOMS_REQUIRED',
                ];
                $validator = Validator::make($request->all(), [
                    'disease_name' => 'required',
                    'disease_type' => 'required',
                    'symptoms' => 'required',
                ], $messages);
                if ($validator->fails()) {
                    return response()->json([
                        'error' => $validator->errors(),
                    ],400);
                }
            }
            // Validation => END

            // Initialize Variables
            $arrResp = [];
            $action = 'added';
            // Action
            $isUpdate = (isset($input['id']) && !empty($input['id'])) ? true:false;
            // New Menu Object
            $consultObj = new Consult();
            // Pass Data To Model
            if($isUpdate){
                // If Update True Pass Data To Model
                $consultObj->field['id'] = $input['id'];
                $action = 'updated';
            }
            
            $consultObj->field['user_id'] = $user_id;
            $consultObj->field['disease_name'] = $input['disease_name'];
            $consultObj->field['disease_type'] = $input['disease_type'];
            if(!empty($input['symptoms'])){
                $consultObj->field['symptoms'] = $input['symptoms'];
            }
            if(!empty($input['bathing_habit'])){
                $consultObj->field['bathing_habit'] = $input['bathing_habit'];
            }
            if(!empty($input['sleep'])){
                $consultObj->field['sleep'] = $input['sleep'];
            }
            if(!empty($input['dreams'])){
                $consultObj->field['dreams'] = $input['dreams'];
            }
            if(!empty($input['menstrual_history'])){
                $consultObj->field['menstrual_history'] = $input['menstrual_history'];
            }
            if(!empty($input['obstetric_history'])){
                $consultObj->field['obstetric_history'] = $input['obstetric_history'];
            }
            if(!empty($input['sexual_history'])){
                $consultObj->field['sexual_history'] = $input['sexual_history'];
            }
            if(!empty($input['family_history'])){
                $consultObj->field['family_history'] = $input['family_history'];
            }
            if(!empty($input['blood_pressure'])){
                $consultObj->field['blood_pressure'] = $input['blood_pressure'];
            }
            if(!empty($input['pulse_rate'])){
                $consultObj->field['pulse_rate'] = $input['pulse_rate'];
            }
            if(!empty($input['temprature'])){
                $consultObj->field['temprature'] = $input['temprature'];
            }
            if(!empty($input['appetite'])){
                $consultObj->field['appetite'] = $input['appetite'];
            }
            if(!empty($input['thirst'])){
                $consultObj->field['thirst'] = $input['thirst'];
            }
            if(!empty($input['addiction'])){
                $consultObj->field['addiction'] = $input['addiction'];
            }
            if(!empty($input['thermalReaction'])){
                $consultObj->field['thermalReaction'] = $input['thermalReaction'];
            }
            if(!empty($input['perspiration'])){
                $consultObj->field['perspiration'] = $input['perspiration'];
            }
            if(!empty($input['urine'])){
                $consultObj->field['urine'] = $input['urine'];
            }
            if(!empty($input['stool'])){
                $consultObj->field['stool'] = $input['stool'];
            }
            if(!empty($input['desire'])){
                $consultObj->field['desire'] = $input['desire'];
            }
            
            if($isUpdate){
                // If Update
                $arrResp = $consultObj->updateConsult();
            } else {
                // If Add
                $arrResp = $consultObj->addConsult();
            }
            
            if($arrResp['status']==1){
                // True
                return response()->json([
                    'result' => 'success',
                    'data' => $arrResp,
                ], 200);
            } else {
                // False
                return response()->json([
                    'result' => 'error',
                    'error' => [
                        'code' => 'MEDICAL_RECORD_NOT_FOUND',
                        'message' => 'Unable to store medical record, Please try after sometime!'
                    ],
                ], 404);
            }
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
            return response()->json([
                'result' => 'error',
                'message' => 'SERVER_ERROR'
            ],400);
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

    public function uploadImage(Request $request, $consult_id=0)
    {
        try{
            if(empty($consult_id)){
                return response()->json([
                    'result' => 'error',
                    "message" => "CONSULT_ID_MISSING"
                ], 404);
            }

            $consultArr = Consult::where('id', $consult_id)->first();
            if (!empty($consultArr))
            {
                $disease_name = $consultArr->disease_name;
                $user_id = $consultArr->user_id;
                // echo '<pre>'; print_r($user_id); die('controller');

                if($request->has('image'))
                {
                    // Create Directories (SELF)
                    $pathOriginal = public_path().'/uploads/consult-images/';
                    if(!File::exists($pathOriginal)) {
                        // If Not Exist
                        File::makeDirectory($pathOriginal, $mode = 0777, true, true);
                    }

                    $file_data = $request->image;
                    $file = base64_decode($file_data);
                    $file_name = $user_id . '_' . $consult_id . '_' . $name . '_' . time() . '.png'; //creating new name to save
                    $size_in_bytes = (int) (strlen(rtrim($file_data, '=')) * 3 / 4);
                    $size = $size_in_bytes / 1024;

                    // PUBLIC => START
                    // $destinationPath = public_path("/uploads/consult-images/");
                    // $file->move($destinationPath, $file_name);
                    // PUBLIC => END

                    // S3 => START

                    Storage::disk('s3')->put('consult-images/'.$file_name, $file, 'public');
                    $url = Storage::disk('s3')->url('consult-images/'.$file_name);
                    // S3 => START

                    $consultimage = new ConsultImage;
                    $consultimage->consult_id = $consult_id;
                    $consultimage->name = $file_name;
                    $consultimage->size = $size;
                    $consultimage->image_url = $url;

                    if($consultimage->save())
                    {
                        return response()->json([
                            "result" => "Success",
                            'data' => $consultimage,
                        ], 200); 
                    } else {
                        return response()->json([
                            'result' => 'error',
                            "message" => "UNABLE_TO_UPLOAD_PLEASE_TRY_AFTER_SOMETIME!"
                        ], 404);
                    }
                }
                else
                {
                    return response()->json([
                        'result' => 'error',
                        'message' => 'NO_FILE_SELECTED',
                        // 'error' => 'NO_FILE_SELECTED',
                    ]);
                }
            }
            else
            {
                return response()->json([
                    'result' => 'error',
                    "message" => "CONSULT_NOT_FOUND"
                ], 404);
            }
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
            return response()->json([
                'result' => 'error',
                'message' => 'SERVER_ERROR',
                'error' => $message
            ],400);
        }
    }
}
