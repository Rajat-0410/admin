<?php

namespace App\Http\Controllers\MedicalRecord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Http\Models\MedicalRecord;
use App\Http\Models\MedicalRecordImage;
use App\Http\Models\User;

use Validator, DB, Storage, File;


class MedicalRecordController extends Controller
{
    
    public function __construct() {
        parent::__construct();
        $this->viewData['page_title'] = 'Medical Record';
    }
    
    public function adminIndex($id, Request $request) {
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

    public function index(Request $request) {
        try{
            $token = $request->header()['token'];
            $user = User::where('api_token', $token)->firstorfail();
            // echo '<pre>'; print_r($user); die('controller');
            $id = $user->id;
            $medicalrecord = MedicalRecord::where('user_id',$id)->get();
            return response()->json([
                'result' => 'success',
                'data' => $medicalrecord,
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

    public function medicalRecordSingle($id)
    {
        try{
            $medicalRecordObj = new MedicalRecord();
            $allRecordArr = $medicalRecordObj->getMedicalDataById($id);
            $allRecordData = $allRecordArr['data'];
            // echo '<pre>'; print_r($allRecordData); exit('controller');
            return response()->json([
                'result' => 'success',
                'data' => $allRecordData,
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
            if(!empty($checkId)) {
                $messages = [
                    'medical_status.in' => 'INVALID_INPUT_TYPE',
                    'time_from.date_format' => 'INVALID_INPUT_TYPE',
                    'time_to.date_format' => 'INVALID_INPUT_TYPE',
                ];
                $validator = Validator::make($request->all(), [
                    'medical_status' => 'in:past,ongoing',
                    'time_from' => 'date_format:Y-m-d',
                    'time_to' => 'date_format:Y-m-d',
                ], $messages);
            } else {
                $messages = [
                    'name.required' => 'NAME_REQUIRED',
                    'status.required' => 'STATUS_REQUIRED',
                    'medical_status.in' => 'STATUS_INVALID_INPUT',
                    'type.required' => 'TYPE_REQUIRED',
                    'time_from.required' => 'DATE_REQUIRED',
                    'time_from.date_format' => 'DATE_INPUT_INVALID',
                    'time_to.date_format' => 'DATE_INPUT_INVALID',
                    'result.required' => 'RESULT_REQUIRED',
                ];
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'medical_status' => 'required|in:past,ongoing',
                    'type' => 'required',
                    'type' => 'required',
                    'time_from' => 'required|date_format:Y-m-d',
                    'time_to' => 'date_format:Y-m-d',
                    'result' => 'required',
                ], $messages);
            }
            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors(),
                ],400);
            }
            // Validation => END

            // Initialize Variables
            $arrResp = [];
            $action = 'added';
            // Action
            $isUpdate = (isset($input['id']) && !empty($input['id'])) ? true:false;
            // New Menu Object
            $medicalRecordObj = new MedicalRecord();
            // Pass Data To Model
            if($isUpdate){
                // If Update True Pass Data To Model
                $medicalRecordObj->field['id'] = $input['id'];
                $action = 'updated';
            }
            
            $medicalRecordObj->field['user_id'] = $user_id;
            $medicalRecordObj->field['name'] = $input['name'];
            $medicalRecordObj->field['medical_status'] = $input['medical_status'];
            $medicalRecordObj->field['type'] = $input['type'];
            $medicalRecordObj->field['time_from'] = $input['time_from'];
            $medicalRecordObj->field['time_to'] = $input['time_to'];
            $medicalRecordObj->field['result'] = $input['result'];
            // $medicalRecordObj->field['status'] = $input['status'];
            
            if($isUpdate){
                // If Update
                $arrResp = $medicalRecordObj->updateMedicalRecord();
            } else {
                // If Add
                $arrResp = $medicalRecordObj->addMedicalRecord();
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
    
    public function uploadImage(Request $request, $id=0)
    {
        try{
            if(empty($id)){
                return response()->json([
                    'result' => 'error',
                    "message" => "MEDICAL_RECORD_ID_MISSING"
                ], 404);
            }

            $medicalrecord = MedicalRecord::where('id', $id)->first();
            if (!empty($medicalrecord))
            {
                $title = $medicalrecord->title;
                $user_id = $medicalrecord->user_id;
                // echo '<pre>'; print_r($user_id); die('controller');

                if($request->has('image'))
                {
                    // Create Directories (SELF)
                    $pathOriginal = public_path().'/uploads/medica-record-images/';
                    if(!File::exists($pathOriginal)) {
                        // If Not Exist
                        File::makeDirectory($pathOriginal, $mode = 0777, true, true);
                    }

                    $file_data = $request->image;
                    $file = base64_decode($file_data);
                    $file_name = $user_id . '_' . $id . '_' . $title . '_' . time() . '.png'; //creating new name to save
                    $size_in_bytes = (int) (strlen(rtrim($file_data, '=')) * 3 / 4);
                    $size = $size_in_bytes / 1024;

                    // PUBLIC => START
                    // $destinationPath = public_path("/uploads/medica-record-images/");
                    // $file->move($destinationPath, $file_name);
                    // PUBLIC => END

                    // S3 => START

                    Storage::disk('s3')->put('medica-record-images/'.$file_name, $file, 'public');
                    $url = Storage::disk('s3')->url('medica-record-images/'.$file_name);
                    // S3 => START

                    $medicalrecordimage = new MedicalRecordImage;
                    $medicalrecordimage->medical_record_id = $id;
                    $medicalrecordimage->image_name = $file_name;
                    $medicalrecordimage->image_url = $url;
                    $medicalrecordimage->size = $size;
                    // $medicalrecordimage->save();

                    if($medicalrecordimage->save())
                    {
                        return response()->json([
                            "result" => "Success",
                            'data' => $medicalrecordimage,
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
                    "message" => "MEDICAL_RECORD_NOT_FOUND"
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

    public function showImage($filename)
    {
        try{
            if(empty($filename)){
                return response()->json([
                    'result' => 'error',
                    "message" => "FILE_NAME_MISSING"
                ], 404);
            }

            return Storage::disk('s3')->response('medica-record-images/',$filename);
            
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
