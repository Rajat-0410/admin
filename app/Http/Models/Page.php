<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB, Request, Auth;

class Page extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages';
    public $field;
    
    public static function getDataWithPaginate($paginate=10,$searchKeyword='') {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        try {
            
            $query = self::query();
            $query->select('pages.id','pages.title','pages.slug','pages.status','pages.created_at');
            // Search Keyword
            if(!empty($searchKeyword)){
                $searchKeywordString = "(title LIKE '%$searchKeyword%' OR slug LIKE '%$searchKeyword%')";
                $query->whereRaw($searchKeywordString);
                // $query->where('title', 'LIKE', '%'.$searchKeyword.'%');
            }
            $query->where('is_deleted','=',0);
            $query->orderBy('created_at', 'desc');
            $arrData = $query->paginate($paginate);
            // print("<pre>"); print_r($arrData); exit('sadas');
            $message = 'Data';
            $status = 1;
            
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        $arrResp['data'] = $arrData;
        
        return $arrResp;
    }
    
    public static function getPagesList() {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        $arrParent = [];
        $arrParent[0] = 'Please select';
        try {
            
            $arrData = self::where('status','=',1)->where('is_deleted','=',0)->pluck('title', 'id');
            // print("<pre>"); print_r($arrData); exit('sadas');
            if(!empty($arrData)){
                foreach ($arrData as $key => $value) {
                    $arrParent[$key] = $value;
                }
                $message = 'Pages list';
            } else {
                $message = 'Pages not available!';
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
    
    public function addPage() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $page = new Page();
            $page->title        = $this->field['title'];
            $page->slug         = $this->field['slug'];
            $page->content      = $this->field['content'];
            $page->meta_title   = $this->field['meta_title'];
            $page->meta_description = $this->field['meta_description'];
            $page->meta_keywords = $this->field['meta_keywords'];
            $page->status = $this->field['status'];
            
            if($page->save()){
                $message = 'Page addded successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to add page, please try again later!';
            }
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }
    
    public function updatePage() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            
            $page = new Page();
            $page->exists       = true;
            $page->id           = $this->field['id'];
            $page->title        = $this->field['title'];
            $page->slug         = $this->field['slug'];
            $page->content      = $this->field['content'];
            $page->meta_title   = $this->field['meta_title'];
            $page->meta_description = $this->field['meta_description'];
            $page->meta_keywords = $this->field['meta_keywords'];
            $page->status = $this->field['status'];
            
            if($page->save()){
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
        
    public function deletePage() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $page = new Page();
            $page->id           = $this->field['id'];
            $page->exists       = true;
            $page->is_deleted   = 1;
            if($page->save()){
                $message = 'Page deleted successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to delete page, please try again later!';
            }
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }
    
    public function getPageDataBySlug($slug = '') {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        $arrData    = [];
        $arrParent = [];
        
         try {
            if(!empty($slug)) {
                
                $arrData = DB::table('pages')
                        ->select('pages.id','pages.title','pages.slug','pages.content','pages.meta_title','pages.meta_description','pages.meta_keywords')
                        ->where('slug','=',$slug)
                        ->where('status','=',1)
                        ->where('is_deleted','=',0)
                        ->first();
                // echo '<pre>';print_r($arrData);exit('test ok update');
                if(!empty($arrData)){
                    $status = 1;
                    $message = 'Page record is available.';
                } else {
                    // Throw New Exception
                    throw new \Exception('Record not available!');
                }
            } else {
                // Throw New Exception
                throw new \Exception('Missing params, Slug empty!');
            }
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        
        $arrResp['status']  =  $status;
        $arrResp['message'] = $message;
        $arrResp['data']    = $arrData;
        return $arrResp;

    }


    
}