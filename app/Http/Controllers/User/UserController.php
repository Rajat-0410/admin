<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Http\Models\User;
use App\Http\Models\Advertisement;
use App\Http\Models\StaticText;
use App\Http\Models\Patient;
use App\Http\Models\MedicalRecord;

use Validator, DB;

class UserController extends Controller
{   
    /*
     * @Date    : Mar 13, 2021
     * @Use     : Show All User
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

    /*
     * @Date    : Mar 13, 2021
     * @Use     : User Login by mobile number
     * @Params  : -
     * @Cretaed By : Rajat Singh
     */
    public function login(Request $request)
    {
        try {
            $messages =[
                'mobile.required' => 'Mobile Number is required',
                'mobile.regex' => 'Mobile Number is invalid',
                'mobile.max' => 'Mobile Number can not be grater than 10',
            ]; 
            $valid = Validator::make($request->all(), [
                'mobile' => 'required|regex:/[0-9]{9}/|max:10',
            ], $messages);
            if ($valid->fails()) {
                return response()->json([
                    'error' => $valid->errors(),
                ],400);
            }
            $mobile = $request->mobile;
            $otp = rand(100000,999999);
            $role_id = config('constant.PATIENT');
            $userDataArr = User::where('mobile', '=', $mobile)->where('role_id', $role_id)->first();
            // echo '<pre>'; print_r($userDataArr); exit;

            if ($userDataArr == null)
            {
                // creating new user
                $user = new User();
                $user->mobile = $mobile;
                $user->otp = $otp;
                $user->ip = $request->ip();
                $user->role_id = $role_id;
                $user->save();

                // Registering as patient
                $patientObj = new Patient();
                $patientObj->user_id = $user->id;
                $patientObj->status = 1;
                $patientObj->is_deleted = 0;
                $patientObj->save();
                
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
                $userDataArr->otp = $otp;
                $userDataArr->ip = $request->ip();
                $userDataArr->save();
                return response()->json(
                [
                    'result' => 'success',
                    'data' => [
                        'id' => $userDataArr->id,
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

    /*
     * @Date    : Mar 13, 2021
     * @Use     : OTP verification
     * @Params  : -
     * @Cretaed By : Rajat Singh
     */
    public function verify($id, Request $request)
    {   
        // echo '<pre>'; print_r($id); exit;
        try{
            $messages =[
                'otp.required' => 'OTP is required',
                'otp.numeric' => 'OTP is invalid',
            ];
            $valid = Validator::make($request->all(), [
                'otp' => 'required|numeric',
            ], $messages);
            if ($valid->fails()) 
            {
                Log::info('LOGINERROR: '. $valid->errors());
                return response()->json([
                    'error' => $valid->errors(),
                ], 400);
            }

            $userId = $id;
            $otp = $request->otp;
            $userData = User::where('id', $userId)->firstorfail();
            // echo '<pre>'; print_r($db_user); exit;

            if($userData->status == 1 && !empty($userData)) {
                if($otp == $userData->otp)
                {
                    $token = hash('sha256', STR::random(120));
                    if ($userData->name == null) 
                    {
                        $userData->api_token = $token;
                        $userData->save();
                        return response()->json(
                            [
                                'result' => 'success',
                                'data' => [
                                    'token' => $userData->api_token,
                                ],
                            ],200);
                    }
                    else 
                    { 
                        $userData->api_token = $token;
                        $userData->save();
                        return response()->json(
                        [
                            'result' => 'success',
                            'data' => [
                                'name' => $userData->name,
                                'token' => $userData->api_token,
                            ],
                        ],200);
                    }
                }
                else
                {
                    return response()->json([
                        'result' => 'error',
                        'error' => [
                            'otp' => 'WRONG_OTP',
                        ],
                        'data' => array('id' => $id,'otp' => $otp),
                        'message' => 'INVALID_OTP',
                    ],406);
                }
            } else {
                Log::info('FPERROR: ', array('id' => $id,'otp' => $otp));
                return response()->json([
                    'result' => 'error',
                    'data' => array('id' => $id,'otp' => $otp),
                    'message' => 'Invalid ID',
                ],406);
            }
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
            Log::info('FPERROR: '.$message);
            return response()->json([
                'result' => 'error',
                // 'data' => array(),
                'message' => 'SERVER_ERROR'
            ],400);
        }	
    }

    public function store(Request $request) {
        try {
            $input = $request->all();
            // echo '<pre>'; print_r($input); exit;

            // Validation => START
            $messages =[
                // 'name.required' => 'Name is required',
                'email.email' => 'Email is Invalid',
            ];
            $valid = Validator::make($request->all(), [
                // 'name' => 'required',
                // 'marketing' => 'boolean'
                'email' => 'email',
            ], $messages);
            if ($valid->fails()) 
            {
                return response()->json([
                    'error' => $valid->errors(),
                ], 400);
            }
            // Validation => END

            // Action
            $token = $request->header()['token'];
            $user = User::where('api_token', $token)->firstorfail();
            $userId = $user->id;
            
            // New Object for user
            $userObj = new User();
            // Pass Data To Model
            $userObj->field['id'] = $userId;
            if(!empty($request->name)){
                $userObj->field['name'] = $request->name;
            }
            if(isset($request->marketing)){
                $userObj->field['marketing'] = $request->marketing;
            }
            if(isset($request->email)){
                $userObj->field['email'] = $request->email;
            }
            $arrResp = $userObj->updateUser();

            // New Object for Patient
            $patientObj = new Patient();
            $input = [];
            if ($request->has('gender')) 
            {
                $gender = $request->gender;
                $input['gender'] = $gender;
            }
            if ($request->has('dob')) 
            {
                $dob = $request->dob;
                $input['dob'] = $dob;
            }
            if ($request->has('blood_group')) 
            {
                $blood_group = $request->blood_group;
                $input['blood_group'] = $blood_group;
            }
            if ($request->has('marital_status')) 
            {
                $marital_status = $request->marital_status;
                $input['marital_status'] = $marital_status;
            }
            if ($request->has('height')) 
            {
                $height = $request->height ;
                $input['height'] = $height;
            }
            if ($request->has('weight')) 
            {
                $weight = $request->weight ;
                $input['weight'] = $weight;
            }
            if ($request->has('smoking')) 
            {
                $smoking = $request->smoking ;
                $input['smoking'] = $smoking;
            }
            if ($request->has('alcohol')) 
            {
                $alcohol = $request->alcohol ;
                $input['alcohol'] = $alcohol;
            }
            if ($request->has('daily_routine_work')) 
            {
                $daily_routine_work = $request->daily_routine_work ;
                $input['daily_routine_work'] = $daily_routine_work;
            }
            if ($request->has('diet')) 
            {
                $diet = $request->diet ;
                $input['diet'] = $diet;
            }
            if ($request->has('occupation')) 
            {
                $occupation = $request->occupation ;
                $input['occupation'] = $occupation;
            }
            $patient = Patient::where('id', $userId)->update($input);

            // echo '<pre>'; print_r($arrResp); exit;
            
            if($arrResp['status']==1 && $patient == 1){
                return response()->json([
                    'result' => 'success',
                    'message' => 'User profile has been updated sucessfully.',
                    // 'data' => array(),
                ],400);
            } else {
                return response()->json([
                    'result' => 'error',
                    'message' => 'Unabel to update user profile, please try again later!',
                    // 'data' => array(),
                ],400);
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

    public function logout(Request $request)
    {
        try{
            $token = $request->header()['token'];
            $user = User::where('api_token', $token)->firstorfail();
            $user->api_token = null;
            $user->save();
            return response()->json([
                'result' => 'success',
                // 'data' => array(),
                // 'message' => 'Invalid ID',
            ],200);
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
            Log::info('FPERROR: '.$message);
            return response()->json([
                'result' => 'error',
                'message' => 'SERVER_ERROR'
            ],400);
        }	
    }

    /*
     * @Date    : Mar 13, 2021
     * @Use     : Dashboard data for mobile user
     * @Params  : -
     * @Cretaed By : Rajat Singh
     */
    public function dashboard()
    {
        try{
            //banner
            $banner = Advertisement::where('is_banner', '1')->where('status', 1)->get();
            $banner_input = [];
            foreach($banner as $index)
            {
                $image_url = $index->image_url;
                $banner_input[] = $image_url;
            }
            //Advertisement
            $ad = Advertisement::where('is_banner', '0')->where('status', 1)->get();

            // moving text
            $used_for = 'dashboard-slider';
            $movtextData = new StaticText;
            $movtext = $movtextData->getDataByUsedFor($used_for);
            $movtext = $movtext['data']->content;

            return response()->json(
            [
                'result' => 'success',
                'data' => [
                    'banner' => $banner_input,
                    'advertisment' => $ad,
                    'movtext' => $movtext,
                ],
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

    public function profile(Request $request)
    {
        try{
            $token = $request->header()['token'];
            // $userObj = User::where('api_token', $token)->firstorfail();
            $userObj = new User();
            $userArr = $userObj->getUserDataByToken($token);
            $userData = $userArr['data'];
            // echo '<pre>'; print_r($userData); exit('controller');
            return response()->json(
            [
                'result' => 'success',
                'data' => [
                    'name'          => $userData->name,
                    'country_code'  => +91,
                    'mobile'        => $userData->mobile,
                    'email'         => $userData->email,
                    'gender'        => $userData['patient']->gender,
                    'dob'           => $userData['patient']->dob,
                    'blood_group'   => $userData['patient']->blood_group,
                    'marital_status' => $userData['patient']->marital_status,
                    'height'        => $userData['patient']->height,
                    'weight'        => $userData['patient']->weight,
                    'address'       => $userData['patient']->location,
                    'image_name'    => $userData['patient']->image_name,
                    'image_url'     => $userData['patient']->image_url,
                    'smoking'       => $userData['patient']->smoking,
                    'alcohol'       => $userData['patient']->alcohol,
                    'daily_routine_work' => $userData['patient']->daily_routine_work,
                    'diet'          => $userData['patient']->diet,
                    'occupation'    => $userData['patient']->occupation,
                ],
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

    public function image(Request $request)
    {
        try{
            $token = $request->header()['token'];
            $user = User::where('api_token', $token)->firstorfail(); 
            $id = $user->id;
            $name = $user->name;
            // echo '<pre>'; print_r($userData); exit('controller');

            if($request->has('image'))
            {
                // Create Directories (SELF)
                $pathOriginal = public_path().'/uploads/profileimage/';
                if(!File::exists($pathOriginal)) {
                    // If Not Exist
                    File::makeDirectory($pathOriginal, $mode = 0777, true, true);
                }

                $file_data = $request->image;
                $file = base64_decode($file_data);
                $file_name = $id . '_' . $name . '_' . time() . '.png'; //creating new name to save
                Storage::disk('s3')->put('profileimage/'.$file_name, $file, 'public');
                $url = Storage::disk('s3')->url('profileimage/'.$file_name);

                // PUBLIC => START
                // $destinationPath = public_path("/uploads/profileimage/");
                // $file->move($destinationPath, $file_name);
                // PUBLIC => END

                $user->image_name = $file_name;
                $user->image_url = $url;
                // $user->save();

                if($user->save())
                {
                    return response()->json([
                        "result" => "Success",
                        'data' => $user,
                    ], 200); 
                } else {
                    return response()->json([
                        'result' => 'error',
                        "message" => "UNABLE_TO_UPLOAD_PLEASE_TRY_AFTER_SOMETIME!"
                    ], 404);
                }
            } else {
                return response()->json([
                    'result' => 'error',
                    'error' => 'NO_FILE_SELECTED',
                ]);
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
}
