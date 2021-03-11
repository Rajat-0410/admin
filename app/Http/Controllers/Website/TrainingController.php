<?php

namespace App\Http\Controllers\Website;

use Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Page;

use Validator, DB, Response;

class TrainingController extends Controller
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
    public function progressive() {
        
        // Set Page Title
        $this->viewData['page_title'] = 'Progressive';
        
        // Set Page Sub Title
        $this->viewData['page_sub_title'] = '';
        
        //
        $slug = 'progressive';
        $pageObj = new Page();
        $arrPageData = $pageObj->getPageDataBySlug($slug);
        $page = '';
        if($arrPageData['status']==1){
            $page = $arrPageData['data'];
        }
        // print("<pre>"); print_r($arrPageData); exit('here');
        $this->viewData['page'] = $page;
                
        return view('website.training.progressive',$this->viewData);
    }
    
    /*
     * @Date    : Oct 15, 2019
     * @Use     : 
     * @Params  : 
     * @Cretaed By : SG
     */
    public function beginner() {
                
        // Set Page Title
        $this->viewData['page_title'] = 'Beginner';
        
        // Set Page Sub Title
        $this->viewData['page_sub_title'] = '';
        
        //
        $slug = 'beginner';
        $pageObj = new Page();
        $arrPageData = $pageObj->getPageDataBySlug($slug);
        $page = '';
        if($arrPageData['status']==1){
            $page = $arrPageData['data'];
        }
        // print("<pre>"); print_r($arrPageData); exit('here');
        $this->viewData['page'] = $page;
                
        return view('website.training.beginner',$this->viewData);
    }
    
    /*
     * @Date    : Oct 15, 2019
     * @Use     : 
     * @Params  : 
     * @Cretaed By : SG
     */
    public function intermediate() {
        
        // Set Page Title
        $this->viewData['page_title'] = 'Intermediate';
        
        // Set Page Sub Title
        $this->viewData['page_sub_title'] = '';
        
        //
        $slug = 'intermediate';
        $pageObj = new Page();
        $arrPageData = $pageObj->getPageDataBySlug($slug);
        $page = '';
        if($arrPageData['status']==1){
            $page = $arrPageData['data'];
        }
        // print("<pre>"); print_r($arrPageData); exit('here');
        $this->viewData['page'] = $page;
                
        return view('website.training.intermediate',$this->viewData);
    }
    
    /*
     * @Date    : Oct 15, 2019
     * @Use     : 
     * @Params  : 
     * @Cretaed By : SG
     */
    public function advance() {
        
        // Set Page Title
        $this->viewData['page_title'] = 'Advance';
        
        // Set Page Sub Title
        $this->viewData['page_sub_title'] = '';
        
        //
        $slug = 'advance';
        $pageObj = new Page();
        $arrPageData = $pageObj->getPageDataBySlug($slug);
        $page = '';
        if($arrPageData['status']==1){
            $page = $arrPageData['data'];
        }
        // print("<pre>"); print_r($arrPageData); exit('here');
        $this->viewData['page'] = $page;
                
        return view('website.training.advance',$this->viewData);
    }
    
    /*
     * @Date    : Oct 15, 2019
     * @Use     : 
     * @Params  : 
     * @Cretaed By : SG
     */
    public function personalizedCoaching() {
        
        // Set Page Title
        $this->viewData['page_title'] = 'Personalized Coaching';
        
        // Set Page Sub Title
        $this->viewData['page_sub_title'] = '';
        
        //
        $slug = 'personalized-coaching';
        $pageObj = new Page();
        $arrPageData = $pageObj->getPageDataBySlug($slug);
        $page = '';
        if($arrPageData['status']==1){
            $page = $arrPageData['data'];
        }
        // print("<pre>"); print_r($arrPageData); exit('here');
        $this->viewData['page'] = $page;
        
        return view('website.training.personalized-coaching',$this->viewData);
    }
    
}
