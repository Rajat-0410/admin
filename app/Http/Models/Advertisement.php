<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB, Request, Auth;

class Advertisement extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'advertisements';
    public $field;
    
    public function getDataWithPaginate($paginate = 10, $searchKeyword = '', $categoryId = 0) {
        $arrResp = [];
        $arrData = [];
        $status = 0;
        $message = '';
        try {
            $query = self::query();
            $query->select('id', 'title', 'slug', 'status', 'publish_date', 'created_at', 'updated_at');
            // Search Keyword
            if(!empty($searchKeyword)) {
                $searchKeywordString = "(title LIKE '%$searchKeyword%' OR slug LIKE '%$searchKeyword%')";
                $query->whereRaw($searchKeywordString);
            }
            $query->where('is_deleted', '=', 0);
            $query->orderBy('publish_date', 'desc');
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

    public function getAllNews($offset = 0,$limit = 0) {
     
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        try {
            $query = self::query();
            $query->where('status','=',1);
            $query->where('is_deleted','=',0);
            $query->orderby('publish_date','desc');
            if(!empty($limit)){
                $query->offset($offset);
                $query->limit($limit);  
            }
            $arrData = $query->get();
            //  dd($arrData);
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
   
    public function getTitle($id=0) {
        $title = '';
        try {
            // 
            $query = self::query();
            $query->select('title');
            $query->where('id','=',$id);
            $arrData = $query->first();
            if(!empty($arrData)){
                $title = $arrData->title;
            }
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        return $title;
    }
    
    public function getCount() {
        $count = 0;
        $query = self::query();
        $query->where('status','=',1);
        $query->where('is_deleted','=',0);
        $count = $query->count();
        return $count;
    }
    
    public function getNewsBySlug($slug='') {
        // echo $slug;exit('in model');
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        try {
            
            $arrData = self::where('status','=',1)
                    ->with('news_gallery')
                    ->where('slug','=',$slug)
                    ->where('is_deleted','=',0)
                    ->orderBy('id', 'asc')
                    ->first();
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
        //echo "<pre>"; print_r($arrResp);exit('in model');
        return $arrResp;
    }

    public function getLoadMore($offset = null,$limit = 0) {
        // echo $slug;exit('in model');
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        try {
            
            $query = self::query();
            $query->where('status','=',1);
            $query->where('is_deleted','=',0);
            $query->orderby('created_at','asc');
            if(!empty($limit)){
                $query->offset($offset);
                $query->limit($limit);  
            }
            $arrData = $query->get();
            print("<pre>"); print_r($arrData); exit('Model');
            $status = 1;
            $message = 'success';
            
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        $arrResp['data'] = $arrData;
        //echo "<pre>"; print_r($arrResp);exit('in model');
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
                $getName = strtolower($this->field['title']);
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
    
    public function addNews() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $news = new News();
            
            $news->title        = $this->field['title'];
            $news->slug         = $this->field['slug'];
            $news->featured_image = $this->field['featured_image'];
            $news->short_description = $this->field['short_description'];
            $news->content      = $this->field['content'];
            $news->status       = $this->field['status'];
            $news->publish_date = $this->field['publish_date'];
            
            if($news->save()){
                $message = 'Post addded successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to add post, please try againa later!';
            }
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }
    
    public function updateNews() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $news = new News();
            $news->exists       = true;
            $news->id           = $this->field['id'];
            $news->title        = $this->field['title'];
            $news->slug         = $this->field['slug'];
            $news->featured_image = $this->field['featured_image'];
            $news->short_description = $this->field['short_description'];
            $news->content      = $this->field['content'];
            $news->status       = $this->field['status'];
            $news->publish_date = $this->field['publish_date'];
            
            if($news->save()){
                $message = 'Post updated successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to update post, please try again later!';
            }
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }
    
    public function deleteNews() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $news = new News();
            $news->id           = $this->field['id'];
            $news->exists       = true;
            $news->is_deleted   = 1;
            if($news->save()){
                $message = 'Post deleted successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to delete post, please try againa later!';
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