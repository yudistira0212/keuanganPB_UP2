<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sp2d;
class SP2DController extends Controller
{
    public function index(){
        $sp2d = Sp2d::all();

        return view('admin.sp2d',['data'=> $sp2d]);
    }

    


}
