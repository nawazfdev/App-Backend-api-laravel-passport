<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function register(){

// return response()->json([
// 'msg'=>'welcome to registration page'


// ]);


return view('Web_Auth.login');

    }
}
