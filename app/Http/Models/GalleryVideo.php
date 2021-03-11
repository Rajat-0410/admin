<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB, Request, Auth;

class GalleryVideo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gallery_videos';
    public $field;
    
    public function getAllGalleryVideos($roundId=0) {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        try {
            
            $arrData = self::select('id','tournament_round_id','title','youtube_id','created_at')
                    ->where('tournament_round_id','=',$roundId)
                    ->where('status', '=', 1)
                    ->where('is_deleted', '=', 0)
                    ->orderby('created_at','desc')
                    ->get();
            // print("<pre>"); print_r($arrData); exit('Model');
            $status = 1;
            $message = 'success';
            
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        $arrResp['data'] = $arrData;
        return $arrResp;
    }
    
    public function getDataWithPaginate($videoGalleryId = 0) {
        $arrResp = [];
        $arrData = [];
        $status = 0;
        $message = '';
        try {
            
            $paginate = 100;
            $query = self::query();
            $query->select('id', 'video_gallery_id', 'title', 'youtube_id', 'status', 'created_at', 'updated_at');
            $query->where('video_gallery_id', '=', $videoGalleryId);
            $query->where('is_deleted', '=', 0);
            $query->orderBy('created_at', 'desc');
            $arrData = $query->paginate($paginate);   
            // print("<pre>"); print_r($arrData); exit('sadas');
            $message = 'Data';
            $status = 1;
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        $arrResp['data'] = $arrData;

        return $arrResp;
    }

    public function addGalleryVideo() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            // 
            $tournamentGalleryVideo = new TournamentGalleryVideo();
            $tournamentGalleryVideo->tournament_round_id   = $this->field['tournament_round_id'];
            $tournamentGalleryVideo->title                 = $this->field['title'];
            $tournamentGalleryVideo->youtube_id           = $this->field['youtube_id'];
            $tournamentGalleryVideo->featured_image        = $this->field['featured_image'];
            $tournamentGalleryVideo->status                = $this->field['status'];

            if($tournamentGalleryVideo->save()){
                $message = 'Gallery Video addded successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to add video, please try again later!';
            }
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }
    
    public function updateGalleryVideo() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            // 
            $tournamentGalleryVideo = new TournamentGalleryVideo();
            $tournamentGalleryVideo->id                    = $this->field['id'];
            $tournamentGalleryVideo->exists                = true;
            $tournamentGalleryVideo->tournament_round_id   = $this->field['tournament_round_id'];
            $tournamentGalleryVideo->title                 = $this->field['title'];
            $tournamentGalleryVideo->youtube_id           = $this->field['youtube_id'];
            $tournamentGalleryVideo->featured_image        = $this->field['featured_image'];
            $tournamentGalleryVideo->status                = $this->field['status'];
            
            if($tournamentGalleryVideo->save()){
                $message = 'Gallery Video updated successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to update video, please try again later!';
            }
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }
    
    public function deleteGalleryVideo() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            // 
            $tournamentGalleryVideo = new TournamentGalleryVideo();
            $tournamentGalleryVideo->id           = $this->field['id'];
            $tournamentGalleryVideo->exists       = true;
            $tournamentGalleryVideo->is_deleted   = 1;
            if($tournamentGalleryVideo->save()){
                $message = 'Video has been deleted successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to delete video, please try againa later!';
            }
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }
    
}