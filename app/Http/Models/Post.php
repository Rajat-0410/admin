<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB, Request, Auth;

class Post extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';
    public $field;
    
    public function post_category() {
        return $this->hasOne('App\Http\Models\Category','id','category_id')
            ->select('id','name')
            ->where('is_deleted', '=' , 0);
    }

    public function getDataWithPaginate($paginate = 10, $searchKeyword = '', $categoryId = 0) {
        $arrResp = [];
        $arrData = [];
        $status = 0;
        $message = '';
        try {
            $query = self::query();
            $query->select('id', 'title', 'slug', 'category_id', 'status', 'publish_date', 'created_at');
            $query->with('post_category');
            // Search Keyword
            if(!empty($categoryId)) {
                $query->Where('category_id', '=', $categoryId);
            }
            if(!empty($searchKeyword)) {
                $searchKeywordString = "(title LIKE '%$searchKeyword%' OR slug LIKE '%$searchKeyword%')";
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

    public function getPostBySlug($slug='') {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        try {
            
            $arrData = self::where('status','=',1)
                    ->where('slug','=',$slug)
                    ->where('is_deleted','=',0)
                    ->orderBy('id', 'asc')
                    ->first();          
            // print("<pre>"); print_r($arrData); exit('Category Model');
            
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
    
    public function getAllPostByCatId($categoryId=0) {
        $status     = 0;
        $message    = '';
        $arrResp    = [];
        $arrData    = [];
        try {
            // 
            $arrData = self::where('status','=',1)
                    ->where('is_deleted','=',0)
                    ->where('category_id','=',$categoryId)
                    ->orderBy('created_at', 'asc')
                    ->get();          
            // print("<pre>"); print_r($arrData); exit('In Model');
            $status = 1;
            $message = 'success';
            
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status']  = $status;
        $arrResp['message'] = $message;
        $arrResp['data']    = $arrData;
        
        return $arrResp;
    }
    
    public function getTotalPostCountByCatId($category_id=0) {
        $count = 0;
        try {
            
            $count = self::where('category_id','=',$category_id)
                    ->where('status','=',1)
                    ->where('is_deleted','=',0)
                    ->orderBy('id', 'asc')
                    ->count();          
            // print("<pre>"); print($count); exit('Model');            
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }        
        return $count;
    }
    
    public function getLoadMorePost($category_id=0,$offset=0,$limit=0) {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        try {
            
            $arrData = self::where('category_id','=',$category_id)
                    ->where('status','=',1)
                    ->where('is_deleted','=',0)
                    ->orderby('created_at','desc')
                    // ->offset($offset)
                    // ->limit($limit)
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
    
    public function addPost() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $post = new Post();
            
            $post->title        = $this->field['title'];
            $post->slug         = $this->field['slug'];
            $post->share_url    = $this->field['share_url'];
            $post->category_id  = $this->field['category_id'];
            $post->featured_image = $this->field['featured_image'];
            $post->short_content = $this->field['short_content'];
            $post->content      = $this->field['content'];
            $post->status       = $this->field['status'];
            $post->publish_date = $this->field['publish_date'];
            
            if($post->save()){
                $message = 'Post addded successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to add post, please try again later!';
            }
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }
    
    public function updatePost() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $post = new Post();
            $post->exists       = true;
            $post->id           = $this->field['id'];
            $post->title        = $this->field['title'];
            $post->slug         = $this->field['slug'];
            $post->share_url    = $this->field['share_url'];
            $post->category_id  = $this->field['category_id'];
            $post->featured_image = $this->field['featured_image'];
            $post->short_content = $this->field['short_content'];
            $post->content      = $this->field['content'];
            $post->status       = $this->field['status'];
            $post->publish_date = $this->field['publish_date'];
            
            if($post->save()){
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
        
    public function deletePost() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $post = new Post();
            $post->id           = $this->field['id'];
            $post->exists       = true;
            $post->is_deleted   = 1;
            if($post->save()){
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