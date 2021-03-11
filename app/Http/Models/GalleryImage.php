<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB, Request, Auth;

class GalleryImage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gallery_images';
    public $field;
    
    public function getAllGalleryImages($galleryId=0) {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        try {
            
            $arrData = self::select('id','gallery_id','image','created_at')
                    ->where('gallery_id','=',$galleryId)
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
    
    public function getDataWithPaginate($galleryId = 0) {
        $arrResp = [];
        $arrData = [];
        $status = 0;
        $message = '';
        try {
            
            $paginate = 100;
            $query = self::query();
            $query->select('id', 'gallery_id', 'image', 'created_at', 'updated_at');
            $query->where('gallery_id', '=', $galleryId);
            $query->orderBy('created_at', 'desc');
            $arrData = $query->paginate($paginate);   
            // print("<pre>"); print_r($arrData); exit('Model');
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
            
    public function deleteImage() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            // 
            $id = $this->field['id'];
            $query = self::query();
            $query->where('id','=',$id);
            if($query->delete()){
                $status = 1;
                $message = 'Image deleted successfully.';
            } else {
                $status = 0;
                $message = 'Unabel to delete Image, please try againa later!';
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