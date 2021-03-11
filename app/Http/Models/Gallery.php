<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB, Request, Auth;

class Gallery extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gallery';
    public $field;
    
    public function getIdBySlug($slug='') {
        $id = '';
        try {
            // 
            $query = self::query();
            $query->select('id');
            $query->where('slug','=',$slug);
            $arrData = $query->first();
            if(!empty($arrData)){
                $id = $arrData->id;
            }
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        return $id;
    }
    
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
    
    public function getDataWithPaginate($paginate = 10, $searchKeyword = '', $categoryId = 0) {
        $arrResp = [];
        $arrData = [];
        $status = 0;
        $message = '';
        try {
            $query = self::query();
            $query->select('id', 'name', 'slug', 'status', 'created_at', 'updated_at');
            // Search Keyword
            if(!empty($searchKeyword)) {
                $searchKeywordString = "(name LIKE '%$searchKeyword%' OR slug LIKE '%$searchKeyword%')";
                $query->whereRaw($searchKeywordString);
            }
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
    
    public function getAllGalleries() {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        try {
            
            $arrData = self::select('id','name','slug','featured_image','order_by','created_at')
                    ->where('status','=',1)
                    ->where('is_deleted','=',0)
                    ->orderby('created_at','desc')
                    ->get();
            // print("<pre>"); print_r($arrData); exit('Model');
            if(count($arrData) > 0){
                $status = 1;
                $message = 'success';
            } else {
                // Throw New Exception
                throw new \Exception('No records found');
            }          
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        $arrResp['data'] = $arrData;
        return $arrResp;
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
    
    public function addGallery() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        $id = 0;
        try {
            $gallery = new Gallery();
            $gallery->name         = ucwords($this->field['name']);
            $gallery->slug         = $this->field['slug'];
            $gallery->featured_image = $this->field['featured_image'];
            $gallery->status       = $this->field['status'];
            if($gallery->save()){
                $id = $gallery->id;
                $message = 'Gallery addded successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to add Gallery, please try againa later!';
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
    
    public function updateGallery() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        $id         = 0;
        try {
            $gallery = new Gallery();
            $id = $this->field['id'];
            $gallery->id           = $this->field['id'];
            $gallery->exists       = true;
            $gallery->name         = ucwords($this->field['name']);
            $gallery->slug         = $this->field['slug'];
            $gallery->featured_image = $this->field['featured_image'];
            $gallery->status       = $this->field['status'];
            if($gallery->save()){
                $message = 'Tournament Gallery updated successfully.';
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
        
    public function deleteGallery() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $gallery = new Gallery();
            $gallery->id           = $this->field['id'];
            $gallery->exists       = true;
            $gallery->is_deleted   = 1;
            if($gallery->save()){
                $message = 'Gallery deleted successfully.';
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