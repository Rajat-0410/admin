<?php

namespace App\Http\Controllers\Website;

use Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Models\State;
use App\Http\Models\City;
use App\Http\Models\ProfessionType;
use App\Http\Models\PospRegistration;
use App\Mail\PospRegistrationEmail;

use Validator, DB, Response;

class HomeController extends Controller
{
    /*
     * @Date        : Dec 07, 2020
     * @Use         : 
     * @Params      : 
     * @Cretaed By  : Rajat Singh
     */
    public function index() {
        return view('website.home.index');
    }

    /*
     * @Date        : Dec 07, 2020
     * @Use         : 
     * @Params      : 
     * @Cretaed By  : Rajat Singh
     */
    public function register(Request $request) {
        try {
            // Request
            $input = $request->all();
            // print("<pre>"); print_r($input); exit('store');

            // Validation => START
            $validator = Validator::make($request->all(), [
                'FirstName' => "required|regex:/^[a-zA-Z ']+$/u",
                'LastName' => "required|regex:/^[a-zA-Z ']+$/u",
                'Gender' => 'required',
                'MobileNumber' => 'required|numeric|digits_between:10,10',
                'EmailAddress' => 'required|email',
                'Address' => 'required|max:255',
                'StateID' => 'required|numeric',
                'CityID' => 'required|numeric',
                'PINCode' => 'required|numeric',
                'AadhaarPan' => 'required',
                'AadharNumber' => 'required|numeric',
                'HighestQualification' => 'required',
                'PassingYear' => 'required|numeric',
                'InstituteName' => 'required',
                'ProfessionType' => 'required|numeric',
                'OrganizationName' => 'required',
            ],[
                'FirstName.required' => 'Please enter first name',
                'FirstName.regex' => 'Contain only letters & space',
                'LastName.required' => 'Please enter last name',
                'LastName.regex' => 'Contain only letters & space',
                'Gender.required' => 'Please select state',
                'MobileNumber.required' => 'Please enter mobile no',
                'MobileNumber.numeric' => 'Please enter valid mobile no',
                'MobileNumber.digits_between' => 'Please enter valid mobile no',
                'EmailAddress.required' => 'Please enter email',
                'EmailAddress.email' => 'Please enter valid email',
                'Address.required' => 'Please enter comment',
                'Address.max' => 'The address may not be greater than 255 characters',
                'StateID.required' => 'Please select State',
                'StateID.numeric' => 'Please select State',
                'CityID.required' => 'Please select City',
                'CityID.numeric' => 'Please select City',
                'PINCode.required' => 'Please enter PIN Code',
                'PINCode.numeric' => 'Please enter PIN Code',
                'AadhaarPan.required' => 'Please select Aadhar or PAN',
                'AadharNumber.required' => 'Please enter Aadhar',
                'AadharNumber.numeric' => 'Aadhar number is not valid',
                'HighestQualification.required' => 'Please select Highest Qualification',
                // 'HighestQualification.numeric' => 'Aadhar number is not valid',
                'PassingYear.required' => 'Please enter Passing Year',
                'PassingYear.numeric' => 'Passing Year number is not valid',
                'InstituteName.required' => 'Please enter Institute Name',
                'ProfessionType.required' => 'Please select Profession Type',
                'ProfessionType.numeric' => 'Please select Profession Type',
                'OrganizationName' => 'required',
            ]);
            // print_r($validator->errors()); exit( "Here");
            // if ($validator->fails()) {
            //     $request->session()->put('tabkey', 'sales');
            //     $activetab = $input['tab'];
            //     // return redirect("support#$activetab")->withErrors($validator)->withInput(); 
            //     // return Redirect::back()->withErrors(['msg', 'The Message']);
            // }
            // Validation => END
            
            // // Get State By ID
            // $stateName = '';
            // if(!empty($input['StateID'])){
            //     $stateObj = new State();
            //     $stateId = $input['StateID'];
            //     $stateData = $stateObj->getStateById($stateId);
            //     // if($arrStateData['status']==1){
            //         $stateName = $stateData;
            //     // }
            // }
            // $input['stateName'] = $stateName;
            
            // // Get City By ID
            // $cityName = '';
            // if(!empty($input['CityID'])){
            //     $cityObj = new City();
            //     $cityId = $input['CityID'];
            //     $cityData = $cityObj->getCityById($cityId);
            //     // if($arrCityData['status']==1){
            //         $cityName = $cityData;
            //     // }
            // }
            // $input['cityName'] = $cityName;

            // Get Profession Type By ID
            $professionTypeName = '';
            if(!empty($input['ProfessionType'])){
                $professionTypeObj = new ProfessionType();
                $professionTypeId = $input['ProfessionType'];
                $professionTypeData = $professionTypeObj->getProfessionTypeById($professionTypeId);
                // if($arrCityData['status']==1){
                    $professionTypeName = $professionTypeData;
                // }
            }
            $input['professionTypeName'] = $professionTypeName;
            print("<pre>"); print_r($input); exit('store');

            // Generate Reference ID
            $reference_id = $this->get_enq_reference_code($input['PassingYear'],$input['MobileNumber']);
            $input['ReferenceID'] = $reference_id;
            
            // Initialize Variables
            $arrResp = [];
            $action = 'added';
            $pospRegistration = new PospRegistration();
            
            $pospRegistration->field['reference_id'] = $input['ReferenceID'];
            $pospRegistration->field['first_name'] = $input['FirstName'];
            $pospRegistration->field['last_name'] = $input['LastName'];
            $pospRegistration->field['gender'] = $input['Gender'];
            // $pospRegistration->field['dob'] = $input['MobileNumber'];
            $pospRegistration->field['mobile'] = $input['MobileNumber'];
            $pospRegistration->field['email'] = $input['EmailAddress'];
            $pospRegistration->field['address'] = $input['Address'];
            $pospRegistration->field['state_id'] = $input['StateID'];
            $pospRegistration->field['city_id'] = $input['CityID'];
            $pospRegistration->field['pincode'] = $input['PINCode'];
            $pospRegistration->field['aadhar_number'] = !empty($input['AadhaarPan']) ? $input['AadhaarPan'] : ''; //
            $pospRegistration->field['pan_number'] = !empty($input['AadhaarPan']) ? $input['AadhaarPan'] : ''; // 
            $pospRegistration->field['highest_qualification'] = $input['HighestQualification'];
            $pospRegistration->field['passing_year'] = $input['PassingYear'];
            $pospRegistration->field['institute_name'] = $input['InstituteName'];
            $pospRegistration->field['profession_type'] = $input['professionTypeName'];
            $pospRegistration->field['oraganisation_name'] = $input['OrganizationName'];
            // print("<pre>"); print_r($pospRegistration); exit();

            // Upload aadhar 
            if(!empty($request->file('AadharCardFile'))) {
                $fileName = pathinfo($input['AadharCardFile']);
                $file = $request->file('AadharCardFile');
                //get file extension
                $extension = $file->getClientOriginalExtension();
                $file_name = $file->getClientOriginalName();
                $aadharCardFileFileName = $reference_id.'_AD_'.$input['FirstName'].'_'.time().'.'.$extension;
                $destinationPath = public_path('/uploads/documents/');
                $file->move($destinationPath, $aadharCardFileFileName);
            } else {
                $aadharCardFileFileName = NULL; 
            }
            $pospRegistration->field['addhar_name'] = $aadharCardFileFileName;
            
            // Upload PAN 
            if(!empty($request->file('QualificationCertificateFile'))) {
                $fileName = pathinfo($input['QualificationCertificateFile']);
                $file = $request->file('QualificationCertificateFile');
                //get file extension
                $extension = $file->getClientOriginalExtension();
                $file_name = $file->getClientOriginalName();
                $qualificationCertificateFileFileName = $reference_id.'_PN_'.$input['FirstName'].'_'.time().'.'.$extension;
                $destinationPath = public_path('/uploads/documents/');
                $file->move($destinationPath, $qualificationCertificateFileFileName);
            } else {
                $qualificationCertificateFileFileName = NULL; 
            }
            $pospRegistration->field['pan_name'] = $qualificationCertificateFileFileName;
            
            // Upload hieghest qualification
            if(!empty($request->file('QualificationCertificateFile'))) {
                $fileName = pathinfo($input['QualificationCertificateFile']);
                $file = $request->file('QualificationCertificateFile');
                //get file extension
                $extension = $file->getClientOriginalExtension();
                $file_name = $file->getClientOriginalName();
                $qualificationCertificateFileFileName = $reference_id.'_HQ_'.$input['FirstName'].'_'.time().'.'.$extension;
                $destinationPath = public_path('/uploads/documents/');
                $file->move($destinationPath, $qualificationCertificateFileFileName);
            } else {
                $qualificationCertificateFileFileName = NULL; 
            }
            $pospRegistration->field['hieghest_qualification_name'] = $qualificationCertificateFileFileName;
            
            // Upload cancelled cheque
            if(!empty($request->file('CancelledChequeFile'))) {
                $fileName = pathinfo($input['CancelledChequeFile']);
                $file = $request->file('CancelledChequeFile');
                //get file extension
                $extension = $file->getClientOriginalExtension();
                $file_name = $file->getClientOriginalName();
                $cancelledChequeFileFileName = $reference_id.'_CC_'.$input['FirstName'].'_'.time().'.'.$extension;
                $destinationPath = public_path('/uploads/documents/');
                $file->move($destinationPath, $cancelledChequeFileFileName);
            } else {
                $cancelledChequeFileFileName = NULL; 
            }
            $pospRegistration->field['cancelled_cheque_name'] = $cancelledChequeFileFileName;

            $arrResp = $pospRegistration->addPospRegistration();
            // print("<pre>"); print_r($arrResp); exit();

            if($arrResp['status']==1){
                // True
                $message = "Psop Registration has been posted successfully.";
                
                // Send A Thank You Email To Customer
                $input['email_subject'] = 'Thanks For registring';
                $emailRespCust = Mail::to($input['EmailAddress'])
                    // ->bcc($allSMILPEmailMerge)
                    ->send(new PospRegistrationEmail($input));

                print("<pre>"); print_r($emailRespCust); exit();
            } else {
                // False
                throw new \Exception('Unabel to post Posp Registration, please try again later!');
            }
        } catch (\Exception $ex) {
            echo 'catch';
            echo $message = $ex->getMessage(); die();
            $alertClass = 'alert-danger';
            $iconClass = 'icon fa fa-ban';
        }
        Session::flash('message', $message); 
        Session::flash('alert-class', $alertClass); 
        Session::flash('icon-class', $iconClass);
        return redirect('/');
    }
        
    /*
     * @Date    : Dec 07, 2020
     * @Use     : 
     * @Params  : -
     * @Cretaed By : Rajat Singh
     */
    function get_enq_reference_code($id=0,$phone=0){
        $day = substr(date('Y-m-d'), 8, 2);
        $referencekey = 'POSP-' . $id . $day;
        if(!empty($phone)){
            $phones = substr(str_shuffle($phone), 0, 2);
            $referencekey .= $phones;
        }
        return $referencekey;
    }
}
