<?php

namespace App\Http\Controllers\Website;

use Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Models\ContactUs;

use App\Mail\ContactUsEmail;

use Validator, DB, Response, Mail;

class HomeController extends Controller
{
    
    public function __construct() {
        parent::__construct();
    }
    
    /*
     * @Date    : Oct 14, 2019
     * @Use     : 
     * @Params  : 
     * @Cretaed By : SG
     */
    public function index() {
        // Set Page Title
        $this->viewData['page_title'] = 'Home';
                
        return view('website.home.index',$this->viewData);
    }
    
    /*
     * @Date    : Oct 14, 2019
     * @Use     : 
     * @Params  : 
     * @Cretaed By : SG
     */
    public function aboutUs() {
        // Set Page Title
        $this->viewData['page_title'] = 'About Us';
                
        return view('website.home.about-us',$this->viewData);
    }
    
    /*
     * @Date    : Oct 14, 2019
     * @Use     : 
     * @Params  : 
     * @Cretaed By : SG
     */
    public function contactUs() {
        // Set Page Title
        $this->viewData['page_title'] = 'Contact Us';
        
        return view('website.home.contact-us',$this->viewData);
    }
    
    /*
     * @Date    : Oct 14, 2019
     * @Use     : 
     * @Params  : 
     * @Cretaed By : SG
     */
    public function storeContactUs(Request $request) {
        
        $input = $request->all();
        // echo '<pre>'; print_r($input); exit;
        // Validation => START
        $validator = Validator::make($request->all(), [
            'name'          => "required|regex:/^[a-zA-Z ']+$/u",
            'email'         => 'required|email',
            'phone_number'  => 'required',
            'message'       => 'required',
        ],[
            'name.required'     => 'Name field is required',
            'name.regex'        => 'Contain only letters & space',
            'email.required'    => 'Email field is required',
            'email.email'       => 'Invalid email',
            'phone_number.required' => 'Phone field is required',
            'message.required'  => 'Message field is required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Validation => END
        // Initialize Variables
        $arrResp = [];
        
        // New Object
        $contactUs = new ContactUs();
        
        $contactUs->field['name'] = $input['name'];
        $contactUs->field['email'] = $input['email'];
        $contactUs->field['phone_number'] = $input['phone_number'];
        $contactUs->field['message'] = $input['message'];
        
        $arrResp = $contactUs->saveEnquiry();

        $email_club = ['kumarnaresh870@gmail.com'];
        // $email_club = ['dev@fondostech.in'];
        
        if($arrResp['status']==1){
            //
            $input['subject'] = 'Contact Us Enquiry.';
            // Send An Email
            $arrBCCEmails = config('constant.SUPPORT_EMAIL_BCC');
            $emailResp = Mail::to($email_club)
                ->bcc($arrBCCEmails)
                ->send(new ContactUsEmail($input));
            
            // True
            Session::flash('message', "Thank You for contacting with us."); 
            Session::flash('alert-class', 'alert-success'); 
            Session::flash('icon-class', 'icon fa fa-check');
            return redirect('contact-us');
        } else {
            // False
            Session::flash('message', 'Unabel to sent message, please try again later!'); 
            Session::flash('alert-class', 'alert-danger'); 
            Session::flash('icon-class', 'icon fa fa-ban');
            return redirect('contact-us');
        }
        
    }
    
    /*
     * @Date    : Oct 14, 2019
     * @Use     : 
     * @Params  : 
     * @Cretaed By : SG
     */
    public function commonPage($slug='') {
        dd($slug);
        // Set Page Title
        $this->viewData['page_title'] = '';
                
        return view('website.home.common-page',$this->viewData);
    }
        
}
