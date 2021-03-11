<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB, Request, Auth;

class SliderImage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'slider_images';
    public $field;
    
    public function getData($sliderId = 0) {
        $status     = 0;
        $message    = '';
        $arrData    = [];
        $arrResp    = [];
        
        try {
            
            $arrData = self::query()
                            ->select('id','image','created_at')
                            ->where('slider_id', '=', $sliderId)
                            ->get();
            // print("<pre>"); print_r($arrData); exit;
            
            $message = 'success';
            $status = 1;
            
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status']  = $status;
        $arrResp['message'] = $message;
        $arrResp['data']    = $arrData;
        return $arrResp;
    }
            
    public function deleteSlide() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $slider = new SliderImage();
            $id = $this->field['id'];
            if($slider->where('id', '=', $id)->delete()){
                $message = 'Slider image deleted successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to delete menu, please try againa later!';
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