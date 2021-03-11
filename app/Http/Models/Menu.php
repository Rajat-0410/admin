<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB, Request, Auth;

class Menu extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menus';
    public $field;
    
    public static function getMenusByGroup($groupId=0) {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        try {
            // echo $groupId; exit('fdgdf');
            $arrData = DB::table('menus as m')
                        ->select('m.id','m.name','m.slug','m.page_id','p.id as page_id','p.title as page_title','p.slug as page_slug')
                        // ->select('m.id','m.name','m.slug','m.page_id','p.id as page_id','p.name as page_name','p.slug as page_slug')
                        ->leftJoin('pages as p', 'm.page_id', '=', 'p.id')
                        ->where('m.group_id','=',$groupId)
                        ->where('m.status','=',1)
                        ->where('m.is_deleted','=',0)
                        ->get();
            // print("<pre>"); print_r($arrData); exit('sadas');
            if(!empty($arrData)){
                $message = 'Menu list';
            } else {
                $message = 'Menu not available!';
            }
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
    
    public static function getMenusWithSubMenus($groupId=0) {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        $arrMainMenuNew = [];
        try {
            // 
            $arrData = DB::table('menus as m')
                        ->select('m.id as id','m.parent_id as parent_id','m.name as name','m.slug as slug','m.menu_order','m.page_id as m_page_id','p.id as page_id','p.title as page_title','p.slug as page_slug')
                        ->leftJoin('pages as p', 'm.page_id', '=', 'p.id')
                        ->leftJoin('menus as sm', 'm.id', '=', 'sm.parent_id')
                        ->where('m.group_id','=',$groupId)
                        ->where('m.status','=',1)
                        ->where('m.is_deleted','=',0)
                        ->groupBy('id')
                        ->orderBy('m.menu_order','asc')
                        ->get();
            // print("<pre>"); print_r($arrData); exit('sadas');
            if(!empty($arrData)){
                
                $status = 1;
                $message = 'Menus list';
                // 
                $arrMainMenu = [];
                //
                $arrMenus = $arrData;
                // print("<pre>"); print_r($arrMenus); exit('all'); 
                foreach($arrMenus as $key => $menu){
                    $id = $menu->id;
                    $parent_id = $menu->parent_id;
                    $name = $menu->name;
                    $slug = $menu->slug;
                    // 
                    $page_id = $menu->page_id;
                    $page_slug = $menu->page_slug;
                    if(empty($parent_id)){
                        $arrMainMenu['main'][] = [
                                        'id' => $id,
                                        'parent_id' => $parent_id,
                                        'name' => $name,
                                        'page_id' => $page_id,
                                        'page_slug' => $page_slug,
                                    ];
                    } else {
                        $arrMainMenu['submenu'][$parent_id][] = [
                                        'id' => $id,
                                        'parent_id' => $parent_id,
                                        'name' => $name,
                                        'page_id' => $page_id,
                                        'page_slug' => $page_slug,
                                    ];
                    }
                }
                // print("<pre>"); print_r($arrMainMenu); exit('all');
                if(!empty($arrMainMenu['main'])){
                    $arrSubMenu = $arrMainMenu['submenu'];
                    foreach ($arrMainMenu['main'] as $mkey => $mvalue) {
                        $arrMainMenuNew[$mkey] = $mvalue;
                        $menuId = $mvalue['id'];
                        if(isset($arrSubMenu[$menuId]) && !empty($arrSubMenu[$menuId])){
                            $arrMainMenuNew[$mkey]['sub_menus'] = $arrSubMenu[$menuId];
                        } else {
                            $arrMainMenuNew[$mkey]['sub_menus'] = [];
                        }
                    }
                }
                // print("<pre>"); print_r($arrMainMenuNew); exit('all');
                
            } else {
                // Exception
                throw new Exception('Menu not available!');
            }
            
        } catch (\Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        $arrResp['data'] = $arrMainMenuNew;
        
        return $arrResp;
    }
    
    public static function getMainMenusList() {
        $arrResp    = [];
        $arrData    = [];
        $status     = 0;
        $message    = '';
        $arrParentMenu = [];
        $arrParentMenu[0] = 'Select Parent Menu';
        try {
            
            $arrData = self::where('status','=',1)->where('is_deleted','=',0)->where('parent_id','=',0)->pluck('name', 'id');
            if(!empty($arrData)){
                foreach ($arrData as $key => $value) {
                    $arrParentMenu[$key] = $value;
                }
                $message = 'Menu list';
            } else {
                $message = 'Menu not available!';
            }
            $status = 1;
            
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        $arrResp['data'] = $arrParentMenu;
        
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
    
    public function addMenu() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $menu = new Menu();
            $menu->group_id      = $this->field['group_id'];
            $menu->parent_id    = $this->field['parent_id'];
            $menu->name         = ucwords($this->field['name']);
            $menu->slug         = $this->field['slug'];
            $menu->page_id      = $this->field['page_id'];
            $menu->status       = $this->field['status'];
            if($menu->save()){
                $message = 'Menu addded successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to add menu, please try againa later!';
            }
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        return $arrResp;
    }
    
    public function updateMenu() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $menu = new Menu();
            $menu->id           = $this->field['id'];
            $menu->exists       = true;
            $menu->group_id      = $this->field['group_id'];
            $menu->parent_id    = $this->field['parent_id'];
            $menu->name         = ucwords($this->field['name']);
            $menu->slug         = $this->field['slug'];
            $menu->page_id      = $this->field['page_id'];
            $menu->status       = $this->field['status'];
            if($menu->save()){
                $message = 'Menu updated successfully.';
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
        return $arrResp;
    }
    
    public function updateStatus() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $menu = new Menu();
            $menu->id       = $this->field['id'];
            $menu->exists   = true;
            $menu->status   = $this->field['status'];
            if($menu->save()){
                $message = 'Menu deleted successfully.';
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
    
    public function deleteMenu() {
        $arrResp    = [];
        $status     = 0;
        $message    = '';
        try {
            $menu = new Menu();
            $menu->id           = $this->field['id'];
            $menu->exists       = true;
            $menu->is_deleted   = 1;
            if($menu->save()){
                $message = 'Menu deleted successfully.';
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