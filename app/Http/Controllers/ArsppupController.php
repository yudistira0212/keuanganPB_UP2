<?php

namespace App\Http\Controllers;

use App\Models\SppArsip;
use Illuminate\Http\Request;

class ArsppupController extends Controller
{
    public function index()
    {
        $SppArsip = SppArsip::where('jenis', 'UP')->get();
        return view('admin.arsip.arsip_spp.arsip_spp_up', compact('SppArsip'));
    }
}
