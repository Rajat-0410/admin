<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB,
    Request,
    Auth;

class Membership extends Model {

    protected $table = 'membership';
    public $field;
    
    public function addmembership() {
        // print("<pre>"); print_r($this->field); exit('model');

        $arrResp = [];
        $status = 0;
        $message = '';
        $lastId     = 0;
        try {
            $membership = new Membership();
            $membership->name = ucwords($this->field['name']);
            $membership->age = $this->field['age'];
            $membership->parent_guardian = ucwords($this->field['parent_guardian']);
            $membership->address = $this->field['address'];
            $membership->mobile = $this->field['mobile'];
            $membership->email = $this->field['email'];
            $membership->preferredCentre = $this->field['preferredCentre'];
            $membership->trainingProgram = $this->field['trainingProgram'];

            if ($membership->save()) {
                $lastId =  $membership->id;
                $message = 'Membership addded successfully.';
                $status = 1;
            } else {
                $status = 0;
                $message = 'Unabel to add, please try again later!';
            }
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
        }
        $arrResp['status'] = $status;
        $arrResp['message'] = $message;
        $arrResp['lastId'] = $lastId;
        return $arrResp;
    }
}
