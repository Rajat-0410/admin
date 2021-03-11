<?php

namespace App\Http\Controllers\ActionLog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use App\Http\Models\ActionLog;

use Validator, DB, Image;


class ActionLogController extends Controller
{
    
    public function __construct() {
        parent::__construct();
        $this->viewData['page_title'] = 'Action Logs';
    }
    
    /*
     * @Date    : April 04, 2019
     * @Use     : Show Offer listing
     * @Params  : -
     * @Cretaed By : SD
     */
    public function history($controller='',$recordId=0,$productId=0) {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'All Action Logs';
        
        $keyword = '';
        if(isset($input['keyword']) && !empty($input['keyword'])){
           $keyword = $input['keyword'];
        }
        $recordId = base64_decode($recordId);
        $recordName = '';
        // Get Record Name
        if($controller=='product'){
            $productObj = new \App\Http\Models\Product();
            $arrRespData = $productObj->getProductName($recordId);
            $recordName = $arrRespData['name'];
        } else if($controller=='social-update'){
            $socialUpdateObj = new \App\Http\Models\SocialUpdate;
            $recordName = $socialUpdateObj->getTitle($recordId);
        } else if($controller=='accessory'){
            $accessoriesObj = new \App\Http\Models\Accessory;
            $recordName = $accessoriesObj->getName($recordId);
        } else if($controller=='variant'){
            $variantObj = new \App\Http\Models\Variant;
            $recordName = $variantObj->getName($recordId);
        } else if($controller=='color'){
            $colorObj = new \App\Http\Models\ProductColor;
            $recordName = $colorObj->getName($recordId);
        } else if($controller=='feature'){
            $featureObj = new \App\Http\Models\Feature;
            $recordName = $featureObj->getName($recordId);
        } else if($controller=='productspecification'){
            $productSpecificationObj = new \App\Http\Models\ProductSpecification;
            $recordName = $productSpecificationObj->getName($recordId);
        } else if($controller=='media-review'){
            $productMediaReviewObj = new \App\Http\Models\ProductMediaReview;
            $recordName = $productMediaReviewObj->getName($recordId);
        } else if($controller=='product-video-gallery'){
            $productGalleryVideoObj = new \App\Http\Models\ProductGalleryVideo;
            $recordName = $productGalleryVideoObj->getName($recordId);
        } else {
            if($controller=='product-overview'){
                $recordName = 'Product Overview';
            } else if($controller=='awards'){
                $recordName = 'Award';
            } else if($controller=='brochure'){
                $recordName = 'Brochure';
            } else if($controller=='product-360-media'){
                $recordName = 'Product 360 Media';
            } else if($controller=='product-image-gallery'){
                $recordName = 'Product Image Gallery';
            } else if($controller=='product-campaign-image'){
                $recordName = 'Product Campaign Image';
            } else {
                $recordName = $controller;
            }
        }
        
        // ActionLog
        $actionLogObj = new ActionLog();
        $arrResp = $actionLogObj->getDataWithPaginate($controller,$recordId);
        $this->viewData['all_records'] = $arrResp['data'];
        $this->viewData['keyword'] = $keyword;
        $this->viewData['no_records_found'] = config('constant.NO_RECORDS_FOUND');
        $this->viewData['arr_status'] = config('constant.STATUS');
        $this->viewData['record_id'] = $recordId;
        $this->viewData['record_name'] = $recordName;
        $this->viewData['controller'] = $controller;
        $this->viewData['productId'] = $productId;
        // print("<pre>"); print_r($this->viewData); exit('sadas');
        return view('action-log.history',$this->viewData);
    }
        
    /*
     * @Date    : April 04, 2019
     * @Use     : Edit Offer
     * @Params  : -
     * @Cretaed By : SD
     */
    public function edit($id) {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'Edit Offer';
        // New Product Specification Object
        $offer = Offer::find(base64_decode($id));
        $this->viewData['id'] = $offer->id;
        $this->viewData['title'] = $offer->title;
        $this->viewData['slug'] = $offer->slug;
        $this->viewData['featured_image'] = $offer->featured_image;
        $this->viewData['terms_condition'] = $offer->terms_condition;
        $this->viewData['disclaimer'] = $offer->disclaimer;
        $this->viewData['description'] = $offer->description;
        $this->viewData['status'] = $offer->status;
        // echo '<pre>'; print_r($this->viewData); exit;
        $this->viewData['arr_status'] = config('constant.STATUS');
        $this->viewData['allowfiletypetext'] = config('constant.ALLOW_FILE_TYPE_TEXT');
        $this->viewData['filetype'] = config('constant.File_TYPE');
        return view('offer.edit',$this->viewData);
    }
            
}
