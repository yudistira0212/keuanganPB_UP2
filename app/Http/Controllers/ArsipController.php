<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArsipController extends Controller
{
    public function index()
    {

        return view('admin.arsip.arsip_lainnya.arsip');
    }

    public function create()
    {

        return view('admin.arsip.arsip_lainnya.lainnya');
    }
}
