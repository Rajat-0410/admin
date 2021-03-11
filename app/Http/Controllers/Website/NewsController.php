<?php

namespace App\Http\Controllers\Website;

use Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Post;
use App\Http\Models\Feature;
use App\Http\Models\Event;
use App\Http\Models\News;
use App\Http\Models\TournamentGallery;
use App\Http\Models\Sponsor;
use Validator, DB;

class NewsController extends Controller
{
    
    public function __construct() {
        parent::__construct();
        // // Set Page Title
        $this->viewData['page_title'] = 'Home';
    }
    
    /*
     * @Date    : Mar 20, 2019
     * @Use     : 
     * @Params  : 
     * @Cretaed By : SG
     */
    public function index() {
        // Set Page Sub Title
        $this->viewData['page_sub_title'] = '';
        
        // echo number_format(281.59,2,'.',''); exit;
        
        // Get News
        $newsObj = new News();
        $offset = 0;
        $limit  = 6;
        $arrNewsData = $newsObj->getAllNews($offset,$limit);
        $this->viewData['arrNewsData'] = $arrNewsData['data'];
        // 
        $news_count = $newsObj->getCount();
        $this->viewData['news_count'] = $news_count;
        // dd($news_count);
        return view('website.news.index',$this->viewData);
    }

    public function newsDetails($slug)
    {
        // Get News Detail
        $newsObj = new News();
        $arrNewsDetails = $newsObj->getNewsBySlug($slug);
        $this->viewData['arrNewsDetails'] = $arrNewsDetails['data'];
        // 
        $offset = 0;
        $limit  = 3;
        $arrRecNewsData = $newsObj->getAllNews($offset,$limit);
        $this->viewData['arrRecNewsData'] = $arrRecNewsData['data'];
        return view('website.news.news-detail',$this->viewData);
    }

    public function loadMoreNews(Request $request)
    { 
       
        $arrJson    = array();
        $status     = 0;
        $message    = '';
        $arrNewsData = [];
            
        // 
        $input = $request->all();
        if(!empty($input)){
            // echo '<pre>'; print_r($input); exit('here');
            $load_more  = $input['load_more'];
            $newsObj = new News();
            $arrNews = $newsObj->getAllNews();
            $arrNewsData = $arrNews['data'];
        }
        //echo '<pre>'; print_r($arrNewsData); exit('here');
        $this->viewData['arrNewsData'] = $arrNewsData;
        return view('website.news.load-more-news',$this->viewData);     
    }
}
