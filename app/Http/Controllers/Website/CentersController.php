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

class CentersController extends Controller
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
    public function club5() {
        
        // Set Page Title
        $this->viewData['page_title'] = 'Club 5';
        
        // Set Page Sub Title
        $this->viewData['page_sub_title'] = '';
        
        //
        $slug = 'club-5';
        $pageObj = new Page();
        $arrPageData = $pageObj->getPageDataBySlug($slug);
        $page = '';
        if($arrPageData['status']==1){
            $page = $arrPageData['data'];
        }
        // print("<pre>"); print_r($arrPageData); exit('here');
        $this->viewData['page'] = $page;
                
        return view('website.centers.club-5',$this->viewData);
    }
    
    /*
     * @Date    : Oct 15, 2019
     * @Use     : 
     * @Params  : 
     * @Cretaed By : SG
     */
    public function clubVita() {
        
        // Set Page Title
        $this->viewData['page_title'] = 'Club Vita';
        
        // Set Page Sub Title
        $this->viewData['page_sub_title'] = '';
        
        //
        $slug = 'club-vita';
        $pageObj = new Page();
        $arrPageData = $pageObj->getPageDataBySlug($slug);
        $page = '';
        if($arrPageData['status']==1){
            $page = $arrPageData['data'];
        }
        // print("<pre>"); print_r($arrPageData); exit('here');
        $this->viewData['page'] = $page;
                
        return view('website.centers.club-vita',$this->viewData);
    }
    
    /*
     * @Date    : Oct 15, 2019
     * @Use     : 
     * @Params  : 
     * @Cretaed By : SG
     */
    public function crestClub() {
        
        // Set Page Title
        $this->viewData['page_title'] = 'Crest Club';
        
        // Set Page Sub Title
        $this->viewData['page_sub_title'] = '';
        
        //
        $slug = 'crest-club';
        $pageObj = new Page();
        $arrPageData = $pageObj->getPageDataBySlug($slug);
        $page = '';
        if($arrPageData['status']==1){
            $page = $arrPageData['data'];
        }
        // print("<pre>"); print_r($arrPageData); exit('here');
        $this->viewData['page'] = $page;
        
        return view('website.centers.crust-club',$this->viewData);
    }
        
}
