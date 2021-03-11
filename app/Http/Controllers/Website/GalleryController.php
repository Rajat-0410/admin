<?php

namespace App\Http\Controllers\Website;

use Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Gallery;
use App\Http\Models\GalleryImage;
use App\Http\Models\GalleryVideo;

use Validator, DB, Response;

class GalleryController extends Controller
{
    
    public function __construct() {
        parent::__construct();
        // Set Page Title
        $this->viewData['page_title'] = 'Gallery';
    }
    
    /*
     * @Date    : Mar 20, 2019
     * @Use     : 
     * @Params  : 
     * @Cretaed By : SG
     */
    public function index($slug='') {
        // Set Page Sub Title
        $this->viewData['page_sub_title'] = 'Gallery';
        
        // Get Gallery Id
        $galleryId = 1;
        // $gallery = new Gallery();
        // $galleryId = $gallery->getIdBySlug($slug);
        // $galleryName = $gallery->getName($galleryId);
        // $this->viewData['gallery_slug'] = $slug;
        // $this->viewData['gallery_id'] = $galleryId;
        // $this->viewData['gallery_name'] = $galleryName;

        // Get Images
        $galleryImage = new GalleryImage();
        $arrGalleryImageData = $galleryImage->getAllGalleryImages($galleryId);
        // print("<pre>"); print_r($arrGalleryImageData); exit('controller');
        $this->viewData['arrGalleryImageData'] = $arrGalleryImageData['data'];
        
        // Get Images
        // $tournamentGalleryVideo = new TournamentGalleryVideo();
        // $arrTournamentGalleryVideoData = $tournamentGalleryVideo->getAllGalleryVideos($roundId);
        // print("<pre>"); print_r($arrTournamentGalleryVideoData); exit('dfsdfsf');
        
        // // Get Features
        // $tournamentRound = new TournamentRound();
        // $arrTournamentRoundData = $tournamentRound->getAllGalleryRounds($galleryId);
        // // print("<pre>"); print_r($arrTournamentRoundData); exit('dfsdfsf');
        // $this->viewData['arrTournamentRoundData'] = $arrTournamentRoundData['data'];
        
        // return view('website.gallery.index',$this->viewData);
        return view('website/gallery.gallery',$this->viewData);
    }
    
    public function viewGallery($gallery_slug='',$slug='') {
        // Set Page Sub Title
        $this->viewData['page_sub_title'] = 'Gallery';
        
        // Gallery Data
        $galleryId = 0;
        $tournamentGallery = new TournamentGallery();
        $galleryId = $tournamentGallery->getIdBySlug($gallery_slug);
        $galleryName = $tournamentGallery->getName($galleryId);
        $this->viewData['gallery_slug'] = $gallery_slug;
        $this->viewData['gallery_id'] = $galleryId;
        $this->viewData['gallery_name'] = $galleryName;
        
        // Round Data
        $roundId = 0;
        $tournamentRound = new TournamentRound();
        $roundId = $tournamentRound->getIdBySlug($galleryId,$slug);
        $roundName = $tournamentRound->getName($roundId);
        
        $this->viewData['slug'] = $slug;
        $this->viewData['round_id'] = $roundId;
        $this->viewData['round_name'] = $roundName;
        
        // Get Images
        $tournamentGalleryImage = new TournamentGalleryImage();
        $arrTournamentGalleryImageData = $tournamentGalleryImage->getAllGalleryImages($roundId);
        // print("<pre>"); print_r($arrTournamentGalleryImageData); exit('dfsdfsf');
        $this->viewData['arrTournamentGalleryImageData'] = $arrTournamentGalleryImageData['data'];
        
        // Get Images
        $tournamentGalleryVideo = new TournamentGalleryVideo();
        $arrTournamentGalleryVideoData = $tournamentGalleryVideo->getAllGalleryVideos($roundId);
        // print("<pre>"); print_r($arrTournamentGalleryVideoData); exit('dfsdfsf');
        $this->viewData['arrTournamentGalleryVideoData'] = $arrTournamentGalleryVideoData['data'];
        
        return view('website.gallery.view-gallery',$this->viewData);
    }
    
    /*
     * @Date    : Sep 03, 2020
     * @Use     : 
     * @Params  : 
     * @Cretaed By : Rajat Singh
     */
    public function videoGallery($slug='') {
        // Set Page Sub Title
        $this->viewData['page_sub_title'] = 'Gallery';
        
        // Get Gallery Id
        $galleryId = 0;
        // $galleryVideo = new GalleryVideo();
        $slug = 'video-gallery';
        $this->viewData['gallery_slug'] = $slug;
        $this->viewData['gallery_name'] = 'video';
        // $this->viewData['gallery_id'] = $galleryId;
        // $this->viewData['gallery_name'] = $galleryName;
        
        // Get Features
        // $galleryVideo = new GalleryVideo();
        // $arrGalleryVideoData = $galleryVideo->getAllGalleryImages($galleryId);
        // print("<pre>"); print_r($arrGalleryVideoData); exit('gallery');

        // $this->viewData['arrGalleryVideoData'] = $arrGalleryVideoData['data'];
        
        return view('website.gallery.video-gallery',$this->viewData);
    }

    /*
     * @Date    : Sep 03, 2020
     * @Use     : 
     * @Params  : 
     * @Cretaed By : Rajat Singh
     */
    public function imageGallery($slug='') {
        // Set Page Sub Title
        $this->viewData['page_sub_title'] = 'Gallery';
        
        // Get Gallery Id
        // $galleryId = 0;
        // $galleryImage = new GalleryImage();
        $slug = 'image-gallery';
        $this->viewData['gallery_slug'] = $slug;
        // $this->viewData['gallery_id'] = $galleryId;
        // $this->viewData['gallery_name'] = $galleryName;
        $this->viewData['gallery_name'] = 'image';
        
        // Get Features
        // $galleryImage = new GalleryImage();
        // $arrGalleryImageData = $galleryImage->getDataWithPaginate();

        // print("<pre>"); print_r($arrGalleryImageData); exit('gallery');

        // $this->viewData['arrGalleryImageData'] = $arrGalleryImageData['data'];
        
        return view('website.gallery.image-gallery',$this->viewData);
    }
}