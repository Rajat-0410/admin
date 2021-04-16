<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Disease extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'diseases';
    public $field;
    public function disease_category() {
        return $this->belongsTo('App\Http\Models\DiseaseCategorie','id')
            ->select('id','title','description')
            ->where('is_deleted', '=' , 0);
    }
    
    public function getDiseaseDataById($id=0) {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        try {
            $arrData = self::select('id','user_id','gender','dob','blood_group','marital_status','height','weight','image_name','image_url','smoking','alcohol','daily_routine_work','diet','occupation','status','created_at','updated_at')
                        ->with('user')
                        ->with('medica_record')
                        ->with('consult')
                        ->where('id','=',$id)
                        ->first(); 
            $status = 1;
            $message = 'success';
            // print("<pre>"); print_r($arrData); exit(' State Model');
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        $arrResp['data'] = $arrData;
        
        return $arrResp;
    }

    public function getDiseaseDataByCategoryId($paginate = '',$keyword = '',$diseases_categories_id=0) {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        try {
            // $arrData = self::select('id','diseases_categories_id','title','status','created_at','updated_at')
            //             ->with('disease_category')
            //             ->where('diseases_categories_id','=',$diseases_categories_id)
            //             ->get(); 
            // $status = 1;
            // $message = 'success';
            // print("<pre>"); print_r($arrData); exit(' State Model');

            $query = self::query();
            $query->select('id','diseases_categories_id','title','description','status','created_at','updated_at');
            // Search Keyword
            if(!empty($searchKeyword)) {
                $searchKeywordString = "(title LIKE '%$searchKeyword%')";
                $query->whereRaw($searchKeywordString);
            }
            $query->with('disease_category');
            $query->where('is_deleted', '=', 0);
            $query->where('diseases_categories_id', '=', $diseases_categories_id);
            $query->orderBy('created_at', 'desc');
            $arrData = $query->paginate($paginate);            
            // print("<pre>"); print_r($arrData); exit('modal');
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

    public function getDataWithPaginate($paginate = 10, $searchKeyword = '') {
        $arrResp = [];
        $arrData = [];
        $status = 0;
        $message = '';
        try {
            $query = self::query();
            $query->select('id','title','description','image_name','image_url','price','discount_price','status','created_at','updated_at');
            // Search Keyword
            if(!empty($searchKeyword)) {
                $searchKeywordString = "(title LIKE '%$searchKeyword%')";
                $query->whereRaw($searchKeywordString);
            }
            $query->where('is_deleted', '=', 0);
            $query->orderBy('created_at', 'desc');
            $arrData = $query->paginate($paginate);            
            // print("<pre>"); print_r($arrData); exit('modal');
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

    public function addDiseaseCategorie() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $userObj = new User();

            $userObj->name   	= $this->field['name'];
            $userObj->email  	= $this->field['email'];
            $userObj->password  = $this->field['password'];
            $userObj->role_id  	= $this->field['role_id'];
            $userObj->status    = $this->field['status'];

            if($userObj->save()){
                $message = 'User addded successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to add user, please try again later!';
            }
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }
    
    public function updateDiseaseCategorie() {
        // echo '<pre>'; print_r($this->field); die('modal');
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            DB::enableQueryLog();
            $diseaseCategorieObj = new DiseaseCategorie();
            $diseaseCategorieObj->id           	= $this->field['id'];
            $diseaseCategorieObj->title   		= $this->field['title'];
            $diseaseCategorieObj->description  	= $this->field['description'];

            echo '<pre>'; print_r($diseaseCategorieObj); die('modal');

            if($diseaseCategorieObj->save()){
                $message = 'Disease Category updated successfully.';
                $status = 1;
            } else {
                $message = 'Unabel to update Disease Category, please try again later!';
                $status = 0;
            }
        } catch (\Exception $ex) {
            $status = 0;
            echo $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }

    public function deleteDiseaseCategorie() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $userObj = new User();
            $userObj->id           = $this->field['id'];
            $userObj->exists       = true;
            $userObj->is_deleted   = 1;
            if($userObj->save()){
                $message = 'User deleted successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to delete user, please try again later!';
            }
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }

    
    
}