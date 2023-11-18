<?php

namespace App\Http\Controllers;

use App\Models\SppArsip;
use Illuminate\Http\Request;

class ArspplsController extends Controller
{
    public function index()
    {
        $SppArsip = SppArsip::where('jenis', 'LS')->get();
        return view('admin.arsip.arsip_spp.arsip_spp_ls', compact('SppArsip'));
    }
}
