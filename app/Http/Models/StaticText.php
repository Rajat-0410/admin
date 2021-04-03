<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB, Request, Auth;

class StaticText extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'static_texts';
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

    public function getDataByUsedFor($used_for = '') {
        $arrResp = [];
        $arrData = [];
        $status = 0;
        $message = '';
        try {
            $query = self::query();
            $query->select('id', 'content', 'created_at', 'updated_at');
            $query->where('is_deleted', '=', 0);
            $query->where('used_for', '=', $used_for);
            $arrData = $query->first();   
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
    
    public function getCount() {
        $count = 0;
        $query = self::query();
        $query->where('status','=',1);
        $query->where('is_deleted','=',0);
        $count = $query->count();
        return $count;
    }
    
    public function addStaticText() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $staticText = new StaticText();
            
            $staticText->user_for     = $this->field['user_for'];
            $staticText->content      = $this->field['content'];
            
            if($staticText->save()){
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
    
    public function updateStaticText() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $staticText = new StaticText();
            $staticText->exists       = true;
            $staticText->id           = $this->field['id'];
            $staticText->used_for     = $this->field['used_for'];
            $staticText->content      = $this->field['content'];
            
            if($staticText->save()){
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
    
    public function deleteStaticText() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $staticText = new StaticText();
            $staticText->id           = $this->field['id'];
            $staticText->exists       = true;
            $staticText->is_deleted   = 1;
            if($staticText->save()){
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