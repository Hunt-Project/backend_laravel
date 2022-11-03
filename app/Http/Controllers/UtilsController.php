<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilsController extends Controller {
    public function __construct() {
        $this->middleware(['auth:sanctum', 'verified']);
    }
    
}
