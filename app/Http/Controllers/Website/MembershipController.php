<?php

namespace App\Http\Controllers\Website;

use Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Page;
use App\Http\Models\Membership;
use App\Mail\newMembership;
use Illuminate\Support\Facades\Mail;

use Validator, DB, Response;

class MembershipController extends Controller
{
    
    public function __construct() {
        parent::__construct();
    }
    
    /*
     * @Date    : Oct 15, 2019
     * @Use     : 
     * @Params  : 
     * @Cretaed By : SG
     */
    public function kids() {
        
        // Set Page Title
        $this->viewData['page_title'] = 'Kids';
        
        // Set Page Sub Title
        $this->viewData['page_sub_title'] = '';
        
        //
        $slug = 'kids';
        $pageObj = new Page();
        $arrPageData = $pageObj->getPageDataBySlug($slug);
        $page = '';
        if($arrPageData['status']==1){
            $page = $arrPageData['data'];
        }
        // print("<pre>"); print_r($arrPageData); exit('here');
        $this->viewData['page'] = $page;
                
        return view('website.membership.kids',$this->viewData);
    }
    
    /*
     * @Date    : Oct 15, 2019
     * @Use     : 
     * @Params  : 
     * @Cretaed By : SG
     */
    public function adults() {
        
        // Set Page Title
        $this->viewData['page_title'] = 'Adults';
        
        // Set Page Sub Title
        $this->viewData['page_sub_title'] = '';
        
        //
        $slug = 'adults';
        $pageObj = new Page();
        $arrPageData = $pageObj->getPageDataBySlug($slug);
        $page = '';
        if($arrPageData['status']==1){
            $page = $arrPageData['data'];
        }
        // print("<pre>"); print_r($arrPageData); exit('here');
        $this->viewData['page'] = $page;
                
        return view('website.membership.adults',$this->viewData);
    }
    
    /*
     * @Date    : Oct 15, 2019
     * @Use     : 
     * @Params  : 
     * @Cretaed By : SG
     */
    public function professional() {
        
        // Set Page Title
        $this->viewData['page_title'] = 'Professional';
        
        // Set Page Sub Title
        $this->viewData['page_sub_title'] = '';
        
        //
        $slug = 'professional';
        $pageObj = new Page();
        $arrPageData = $pageObj->getPageDataBySlug($slug);
        $page = '';
        if($arrPageData['status']==1){
            $page = $arrPageData['data'];
        }
        // print("<pre>"); print_r($arrPageData); exit('here');
        $this->viewData['page'] = $page;
                
        return view('website.membership.professional',$this->viewData);
    }

    /*
     * @Date    : Sep 24, 2020
     * @Use     : 
     * @Params  : 
     * @Cretaed By : Rajat Singh
     */
    public function membership() {
        
        // Set Page Title
        $this->viewData['page_title'] = 'Membership';
        
        // Set Page Sub Title
        $this->viewData['page_sub_title'] = '';
        
        //
        $slug = 'membership';
        $pageObj = new Page();
        $arrPageData = $pageObj->getPageDataBySlug($slug);
        $page = '';
        if($arrPageData['status']==1){
            $page = $arrPageData['data'];
        }
        // print("<pre>"); print_r($arrPageData); exit('here');
        $this->viewData['page'] = $page;
                
        return view('website.membership.index',$this->viewData);
    }

    /*
     * @Date    : Sep 24, 2020
     * @Use     : 
     * @Params  : 
     * @Cretaed By : Rajat Singh
     */
    public function membershipadd(Request $request) {
        try {
            // Request
            $input = $request->all();
            // print("<pre>"); print_r($input); exit('store');

            // Validation => START
            $validator = Validator::make($request->all(), [
                'name' => "required|regex:/^[a-zA-Z ']+$/u",
                'age' => "required|numeric|digits_between:1,3",
                'parent_guardian' => "required|regex:/^[a-zA-Z ']+$/u",
                'address' => 'required|max:255',
                'mobile' => 'required|numeric|digits_between:10,10',
                'email' => 'required|email',
                'preferredCentre' => 'required|in:Club5,Club Vita,Crest Club',
                'trainingProgram' => 'required|in:Progressive,Beginners,Intermediate,Advance,Personalised Coaching',
            ],[
               'name.required' => 'Please enter Name',
               'name.regex' => 'Please enter Valid Name',
               'age.required' => 'Please enter Age',
               'age.numeric' => 'Please enter Valid Age',
               'age.digits_between' => 'Please enter Valid Age',
               'parent_guardian.required' => 'Please enter Parent / Guardian Name',
               'parent_guardian.regex' => 'Please enter Valid Parent / Guardian Name',
               'address.required' => 'Please enter comment',
               'address.max' => 'The comment may not be greater than 255 characters',
               'mobile.required' => 'Please enter mobile no',
               'mobile.numeric' => 'Please enter valid mobile no',
               'mobile.digits_between' => 'Please enter valid mobile no',
               'email.required' => 'Please enter email',
               'email.email' => 'Please enter valid email',
               'preferredCentre.required' => 'Please select Preferred Centre',
               'trainingProgram.required' => 'Please select Training Program',
            ]);
            // print_r($validator->errors()); exit( "Here");
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                // return Redirect::back()->withErrors(['msg', 'The Message']);
            }
            // Validation => END

            // print("<pre>"); print_r($input); exit('store');
            
            // Initialize Variables
            $arrResp = [];
            $action = 'added';
            $membership = new Membership();

            $membership->field['name'] = $input['name'];
            $membership->field['age'] = $input['age'];
            $membership->field['parent_guardian'] = $input['parent_guardian'];
            $membership->field['address'] = $input['address'];
            $membership->field['mobile'] = $input['mobile'];
            $membership->field['email'] = $input['email'];
            $membership->field['preferredCentre'] = $input['preferredCentre'];
            $membership->field['trainingProgram'] = $input['trainingProgram'];
            // print("<pre>"); print_r($membership); exit('controller');
            $arrResp = $membership->addmembership();
            // print("<pre>"); print_r($arrResp); exit();
            $email = $input['email'];
            $email_club = ['kumarnaresh870@gmail.com'];
            // $email_club = ['dev@fondostech.in'];

            // Send Email
            if($arrResp['status']==1){
                // True
                $message = "Membership has been posted successfully.";
                $alertClass = 'alert-success';
                $iconClass = 'icon fa fa-check';

                $input['email_subject'] = 'Welcome to Gurgaon Tennis academy';
                $arrBCCEmails = config('constant.SUPPORT_EMAIL_BCC');
                
                // customer
                $emailRespCust = Mail::to($email)
                    ->bcc($arrBCCEmails)
                    ->send(new newMembership($input));
                
                // club member 
                $emailRespCust = Mail::to($email_club)
                    ->bcc($arrBCCEmails)
					->send(new newMembership($input));
                // print("<pre>"); print_r($emailRespCust); exit('email');
                // Send An Email => START
            } else {
                // False
                throw new \Exception('Unabel to post Membership, please try again later!');
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
        return redirect('membership');
    }
            
}
