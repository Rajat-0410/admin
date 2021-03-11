<?php

namespace App\Http\Controllers\Api;
use Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Validator, DB;

class HomeController extends Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
}
