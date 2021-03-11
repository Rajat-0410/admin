<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'modules';
    public $field;
    
    public function get_sb_modules() {
        return $this->hasMany('App\Http\Models\Module','parent_id','id')
            ->select('id','name','controller','action','is_visible')
            ->where('status','=',1)->where('is_deleted','=',0)->orderBy('order_by','ASC');
    }
    
    public static function getAllModule() {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        $arrParent = [];
        try {
            
            $arrData = self::select(
                                    'modules.id',
                                    'modules.id as module_id',
                                    'modules.parent_id',
                                    'modules.name',
                                    'modules.fa_icon',
                                    'modules.controller',
                                    'modules.action',
                                    'modules.is_action',
                                    'modules.is_visible',
                                    'modules.allowed_user_roles',
                                    'modules.has_sub_menu'
                                )
                                ->where('parent_id','=',0)
                                ->where('status','=',1)
                                ->where('is_deleted','=',0)
                                ->orderBy('name','asc')
                                ->get();
            // print("<pre>"); print_r($arrData); exit('sadas');
            if(count($arrData) > 0){
                    $arrParent = $arrData;
                $message = 'Module list';
            } else {
                $message = 'Module not available!';
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
    
    public static function getSubModules($parentId=0) {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        try {
            
            $arrData = self::select(
                                    'modules.id',
                                    'modules.id as module_id',
                                    'modules.parent_id',
                                    'modules.name',
                                    'modules.fa_icon',
                                    'modules.controller',
                                    'modules.action',
                                    'modules.is_action',
                                    'modules.is_visible',
                                    'modules.allowed_user_roles',
                                    'modules.has_sub_menu'
                                )
                                ->where('parent_id','=',$parentId)
                                ->where('status','=',1)
                                ->where('is_deleted','=',0)
                                ->orderBy('order_by','asc')
                                ->get();
            // print("<pre>"); print_r($arrData); exit('sadas');
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
    
    public static function getModuleIdByParams($controller='',$action='') {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        try {
            // dd($controller.'-'.$action);
            $query = self::query();
            $query->select('modules.id','modules.parent_id');
            $query->where('controller','=',$controller);
            if(!empty($action)){
                $query->where('action','=',$action);
            }    
            $query->where('status','=',1);
            $query->where('is_deleted','=',0);
            $arrData = $query->first();
            // print("<pre>"); print_r($arrData); exit('sadas');
            if(!empty($arrData)){
                $status = 1;
                $message = 'success';
            } else {
                $status = 0;
                $message = 'Permission denied!';
            }
            
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        $arrResp['data'] = $arrData;
        
        return $arrResp;
    }
    
}