<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB, Request, Auth;

class Slider extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sliders';
    public $field;
    
    public function getName($id=0) {
        $name = '';
        try {
            // 
            $query = self::query();
            $query->select('name');
            $query->where('id','=',$id);
            $arrData = $query->first();
            if(!empty($arrData)){
                $name = $arrData->name;
            }
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        return $name;
    }
    
    public function createSlug() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        $slugCount  = 0;
        $slugString = '';
        try {
            // Create Slug Logic
            $id = (isset($this->field['id']) && !empty($this->field['id']) ? $this->field['id']:0);
            $slug = (isset($this->field['slug']) && !empty($this->field['slug']) ? $this->field['slug']:'');
            $isCreate = false;
            $isUpdate = false;
            $doAction = false;
            if(!empty($id)){
                // Check if slug is changed when record is updated
                $arrRow = self::query()->select('slug')->where('id', '=', $id)->first();
                $currentSlug = $arrRow->slug;
                if($slug != $currentSlug){ $isUpdate = true; }
            } else {
                $isCreate = true;
            }
            // var_dump($isUpdate); exit('dsfsfd');
            // If Create New Slug
            if($isCreate==true){
                $getName = strtolower($this->field['name']);
                $doAction = true;
            }
            // If Slug is change at the time of update
            if($isCreate==false && $isUpdate==true){
                $getName = $slug;
                $doAction = true;
            }
            if($doAction){
                $replaceString  = str_replace(' ', '-', $getName); // Replaces all spaces with hyphens.
                $slugString     = preg_replace('/[^A-Za-z0-9\-]/', '', $replaceString); // Removes special chars.
                $slugString     = rtrim($slugString,'-'); // Remove last - the string
                // echo $slugString; exit;
                $query = self::query();
                $query->select('id');
                if(!empty($this->field['id']) && !empty($this->field['slug'])){
                    $query->where('slug', '=', "$getName");
                } else {
                    $query->where('slug', '=', "$slugString");
                }
                $query->where('is_deleted','=',0);
                // $query->get();
                $slugCount = $query->count();
                if($slugCount >= 1){
                    $slugString = $slugString."-$slugCount";
                }
                // print("<pre>"); print_r($slugCount); exit;
                if(!empty($slugString)){
                    $message = 'slug created successfully.';
                    $status = 1;
                } else {
                    $status = 0;
                    $message = 'Unabel to create slug, please try again later!';
                }
            } else {
                $status = 1;
                $message = 'slug not changed.';
                $slugString = $slug;
            }
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        $arrResp['str_slug'] = $slugString;
        return $arrResp;
    }
    
    public function addSlider() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        $id = 0;
        try {
            $slider = new Slider();
            $slider->name         = ucwords($this->field['name']);
            $slider->slug         = $this->field['slug'];
            $slider->status       = $this->field['status'];
            if($slider->save()){
                $id = $slider->id;
                $message = 'Slider addded successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to add menu, please try againa later!';
            }
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status']  = $status;
        $arrResp['message'] = $message;
        $arrResp['row_id']  = $id;
        return $arrResp;
    }
    
    public function updateSlider() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        $id         = 0;
        try {
            $slider = new Slider();
            $id = $this->field['id'];
            $slider->id           = $this->field['id'];
            $slider->exists       = true;
            $slider->name         = ucwords($this->field['name']);
            $slider->slug         = $this->field['slug'];
            $slider->status       = $this->field['status'];
            if($slider->save()){
                $message = 'Slider updated successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to update menu, please try againa later!';
            }
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        $arrResp['row_id']  = $id;
        return $arrResp;
    }
    
    public function updateStatus() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $slider = new Slider();
            $slider->id       = $this->field['id'];
            $slider->exists   = true;
            $slider->status   = $this->field['status'];
            if($slider->save()){
                $message = 'Slider deleted successfully.';
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
    
    public function deleteSlider() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $slider = new Slider();
            $slider->id           = $this->field['id'];
            $slider->exists       = true;
            $slider->is_deleted   = 1;
            if($slider->save()){
                $message = 'Slider deleted successfully.';
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