<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB, Request, Auth;

class NewsGallery extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news_gallery';
    public $field;
    
    public function getDataWithPaginate($tournamentRoundId = 0) {
        $arrResp = [];
        $arrData = [];
        $status = 0;
        $message = '';
        try {
            
            $paginate = 100;
            $query = self::query();
            $query->select('id', 'news_id', 'image', 'created_at', 'updated_at');
            $query->where('news_id', '=', $tournamentRoundId);
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
            
    public function deleteImage() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            // 
            $id = $this->field['id'];
            $query = self::query();
            $query->where('id','=',$id);
            if($query->delete()){
                $status = 1;
                $message = 'News Gallery deleted successfully.';
            } else {
                $status = 0;
                $message = 'Unabel to delete news, please try againa later!';
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