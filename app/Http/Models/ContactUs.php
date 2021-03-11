<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB, Request, Auth;

class ContactUs extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contact_us';
    public $field;
    
    public function getDataWithPaginate($paginate = 10, $searchKeyword = '', $categoryId = 0) {
        $arrResp = [];
        $arrData = [];
        $status = 0;
        $message = '';
        try {
            $query = self::query();
            $query->select('id', 'name', 'email', 'phone_number','created_at');
            if(!empty($searchKeyword)) {
                $searchKeywordString = "(name LIKE '%$searchKeyword%' OR email LIKE '%$searchKeyword%')";
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
    
    public function saveEnquiry() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            // 
            $contactUs = new ContactUs();
            // 
            $contactUs->name            = $this->field['name'];
            $contactUs->email           = $this->field['email'];
            $contactUs->phone_number    = $this->field['phone_number'];
            $contactUs->message         = $this->field['message'];
            // 
            if($contactUs->save()){
                $message = 'Enquiry saved successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to add enquiry, please try again later!';
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