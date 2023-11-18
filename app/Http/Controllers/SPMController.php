<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SPMController extends Controller
{
    public function index(){
        return view('admin.spm');
    }
}
