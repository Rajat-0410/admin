<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Models\User;
use Validator;

class AdminController extends Controller
{
    
    public function __construct() {
        parent::__construct();
    }
    
    /*
     * @Date    : Feb 11, 2019
     * @Use     : 
     * @Params  : 
     * @Cretaed By : SG
     */
    public function index() {
        return redirect()->route('authority');
    }
    
    /*
     * @Date    : Feb 11, 2019
     * @Use     : 
     * @Params  : 
     * @Cretaed By : SG
     */
    public function signin() {
        if(Auth::check()){
            return redirect()->route('dashboard');
        }
        return view('admin.signin');
    }
    
    /*
     * @Date    : Feb 11, 2019
     * @Use     : 
     * @Params  : 
     * @Cretaed By : SG
     */
    public function authenticate(Request $request){
        // $password = Hash::make('123456');
        // echo $password; exit();
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect('admin/authority')->withErrors($validator)->withInput();
        }
        
        $input = $request->all();
        // echo '<pre>'; print_r($input); exit;
        $remember_me = (isset($input['remember_me']) && $input['remember_me']==1) ? true:false;
        if(Auth::attempt(['email' => $input['email'], 'password' => $input['password']], $remember_me))
        {
            $userData = [];
            $user = auth()->user();
            $userObj = new User();
            $getUserData = $userObj->getUserDataById($user->id);
            if($getUserData['status']==1){
                $arrUserData = $getUserData['data']->toArray();
                $homePage = $arrUserData['user_role']['home_page'];
                $userData = [
                                'id' => $arrUserData['id'],
                                'name' => $arrUserData['name'],
                                'role_id' => $arrUserData['user_role']['id'],
                                'role' => $arrUserData['user_role']['role'],
                            ];
            }
            // print("<pre>"); print_r($arrUserData); exit('here');
            Session::put('user_data', $userData);
            $redirectPage = ((!empty($homePage)) ? $homePage:'dashboard');
            return redirect()->intended("admin/$redirectPage");
        }
        else
        {
            Session::flash('message', 'Invalid email OR password!'); 
            Session::flash('alert-class', 'alert-danger'); 
            Session::flash('icon-class', 'icon fa fa-ban'); 
        }
        return redirect('admin/authority');
        
    }
    
    /*
     * @Date    : Feb 11, 2019
     * @Use     : 
     * @Params  : 
     * @Cretaed By : SG
     */
    public function dashboard() {
        if(Auth::check()==false){
            return redirect()->route('authority');
        }
        $arrPageData = [];
        $this->viewData['page_title'] = 'Dashboard';
        return view('admin.dashboard', $this->viewData);
    }
    
    /*
     * @Date    : Feb 11, 2019
     * @Use     : 
     * @Params  : 
     * @Cretaed By : SG
     */
    public function signout() {
        Auth::logout();
        Session::flush();
        return redirect('admin/authority');
    }
    
    
}
