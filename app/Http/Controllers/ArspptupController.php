<?php

namespace App\Http\Controllers;

use App\Models\SppArsip;
use Illuminate\Http\Request;

class ArspptupController extends Controller
{
    public function index()
    {
        $SppArsip = SppArsip::where('jenis', 'TUP')->get();
        return view('admin.arsip.arsip_spp.arsip_spp_tup', compact('SppArsip'));
    }
}
