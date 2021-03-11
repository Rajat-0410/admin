<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB, Request, Auth;

class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';
    public $field;



    public function getDataWithPaginate($paginate = 10, $searchKeyword = '') {
        $arrResp = [];
        $arrData = [];
        $status = 0;
        $message = '';
        try {
            $query = self::query();
            $query->select('id', 'name', 'slug', 'status','created_at');
            // Search Keyword
            if(!empty($searchKeyword)) {
                $query->Where('name', 'LIKE', '%' . $searchKeyword . '%');
                $query->orWhere('slug', 'LIKE', '%' . $searchKeyword . '%');
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

//    public function allPost() {
//        return $this->hasMany('App\Http\Models\Post', 'category_id', 'id');
//    }
    
    public function categoryPosts() {
        return $this->hasMany('App\Http\Models\Post', 'category_id', 'id')
                    ->where('status','=',1)
                    ->where('is_deleted','=',0)
                    // ->limit(5)
                    ->orderBy('created_at','desc');
                //->select(['id', 'title', 'slug', 'featured_image', 'content', 'created_at']);
    }

//    public function selectedPost() {
//        return $this->allPost()
//            // ->select('id','title', 'slug' ,'featured_image','content')
//            ->where('status','=', 1)
//            ->where('is_deleted','=', 0)
//            ->limit(2)
//            ->orderBy('created_at', 'desc');
//    }
    
    public static function getAllCategories() {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        $arrParent = [];
        $arrParent[0] = 'None';
        try {
            
            $arrData = self::where('status','=',1)->where('is_deleted','=',0)->pluck('name', 'id');
            // print("<pre>"); print_r($arrData); exit('sadas');
            if(!empty($arrData)){
                foreach ($arrData as $key => $value) {
                    $arrParent[$key] = $value;
                }
                $message = 'Category list';
            } else {
                $message = 'Category not available!';
            }
            $status = 1;
            
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        $arrResp['data'] = $arrParent;
        
        return $arrResp;
    }
    public static function getCategories() {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        $arrParent = [];
        $arrParent[0] = 'None';
        try {
            
            $arrData = self::where('status','=',1)->where('is_deleted','=',0)->where('parent_id','=',0)->pluck('name', 'id');
            // print("<pre>"); print_r($arrData); exit('sadas');
            if(!empty($arrData)){
                foreach ($arrData as $key => $value) {
                    $arrParent[$key] = $value;
                }
                $message = 'Category list';
            } else {
                $message = 'Category not available!';
            }
            $status = 1;
            
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        $arrResp['data'] = $arrParent;
        
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
    
    public function addCategory() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $category = new Category();
            $category->parent_id    = $this->field['parent_id'];
            $category->name         = ucwords($this->field['name']);
            $category->slug         = $this->field['slug'];
            $category->status       = $this->field['status'];
            if($category->save()){
                $message = 'Category addded successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to add category, please try again later!';
            }
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }
    
    public function updateCategory() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $category = new Category();
            $category->id           = $this->field['id'];
            $category->exists       = true;
            $category->parent_id    = $this->field['parent_id'];
            $category->name         = ucwords($this->field['name']);
            $category->slug         = $this->field['slug'];
            $category->status       = $this->field['status'];
            if($category->save()){
                $message = 'Category updated successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to update category, please try again later!';
            }
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }
    
    public function updateStatus() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $category = new Category();
            $category->id       = $this->field['id'];
            $category->exists   = true;
            $category->status   = $this->field['status'];
            if($category->save()){
                $message = 'Category deleted successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to delete category, please try again later!';
            }
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }
    
    public function deleteCategory() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $category = new Category();
            $category->id           = $this->field['id'];
            $category->exists       = true;
            $category->is_deleted   = 1;
            if($category->save()){
                $message = 'Category deleted successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to delete category, please try again later!';
            }
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }
    
    public function getPostsByCatSlug($catSlug='') {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        $arrData    = [];
        try {
            
            $query = self::query();
            // $query->select('id','name','slug');
            $query->with('categoryPosts');
            $query->where('slug','=',$catSlug);
            $query->where('is_deleted','=',0);
            $query->where('status','=',1);
            // $query ->orderBy('created_at', 'desc');
            $arrData = $query->first();
            
            $status = 1;
            $message = 'All Data';
            
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status']  = $status;
        $arrResp['message'] = $message;
        $arrResp['data']    = $arrData;
        return $arrResp;
    }
    
}