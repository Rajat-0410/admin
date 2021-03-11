<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB, Request, Auth;

class MediaImage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'media_images';
    public $field;
    
    public function latest_action_log(){
        return $this->hasOne('App\Http\Models\ActionLog','record_id','id')
                ->where('action_logs.controller', '=', 'media')
                ->latest();
    }
    
    public function action_log() {
        return $this->hasMany('App\Http\Models\ActionLog','record_id','id')
                ->where('action_logs.controller', '=', 'media');
    }
    
    public function getData() {
        $status     = 0;
        $message    = '';
        $arrResp    = [];
        $arrData    = [];
        try {
            
            $paginate = 60;
            $query = self::query();
            $query->select('media_images.id','media_images.title','media_images.image','media_images.created_at','media_images.updated_at');
            $query->with('latest_action_log');
            $query->orderBy('media_images.created_at', 'desc');
            $arrData = $query->paginate($paginate);
            
            $message = 'success';
            $status = 1;
            
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        $arrResp['data'] = $arrData;
        //dd($arrResp);
        return $arrResp;
    }
    
    public function getAllImages($group_type='') {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        $arrData    = [];
        try {
            $query = self::query()->select('id','title','image','created_at');
            $query->with('latest_action_log');
            if(!empty($group_type)){
                $query->where('group_type','=',$group_type);
            }
            $query ->orderBy('created_at', 'desc');
            $arrData = $query->get();
            // print("<pre>"); print_r($arrRow); exit;
            if(count($arrData) > 0){
                $message = 'All images.';
                $status = 1;
            } else {
                $status = 1;
                $message = 'No media available, please upload!';
            }
            
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status']  = $status;
        $arrResp['message'] = $message;
        $arrResp['data']    = $arrData;
        return $arrResp;
    }
        
    public function addImage() {
//        $arrResp    = [];
//        $status     = 0;
//        $message    = '';
//        try {
//            $slider = new SliderImage();
//            $slider->name         = ucwords($this->field['name']);
//            $slider->slug         = $this->field['slug'];
//            $slider->status       = $this->field['status'];
//            if($slider->save()){
//                $message = 'SliderImage addded successfully.';
//                $status = 1;
//            } else {
//                $status = 0;
//                $message = 'Unabel to add menu, please try againa later!';
//            }
//        } catch (Exception $ex) {
//            $status = 0;
//            $message = $ex->getMessage();
//        }
//        $arrResp['status'] = $status;
//        $arrResp['message'] = $message;
//        return $arrResp;
    }
    
    public function updateSlide() {
//        $arrResp    = [];
//        $status     = 0;
//        $message    = '';
//        try {
//            $slider = new SliderImage();
//            $slider->id           = $this->field['id'];
//            $slider->exists       = true;
//            $slider->name         = ucwords($this->field['name']);
//            $slider->slug         = $this->field['slug'];
//            $slider->status       = $this->field['status'];
//            if($slider->save()){
//                $message = 'SliderImage updated successfully.';
//                $status = 1;
//            } else {
//                $status = 0;
//                $message = 'Unabel to update menu, please try againa later!';
//            }
//        } catch (Exception $ex) {
//            $status = 0;
//            $message = $ex->getMessage();
//        }
//        $arrResp['status'] = $status;
//        $arrResp['message'] = $message;
//        return $arrResp;
    }
        
    public function deleteImage() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $mediaImage = new MediaImage();
            $id = $this->field['id'];
            if($mediaImage->where('id', '=', $id)->delete()){
                $message = 'Image deleted successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to delete image, please try again later!';
            }
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }
     
    
}