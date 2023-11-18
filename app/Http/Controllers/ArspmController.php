<?php

namespace App\Http\Controllers;

use App\Models\SpmArsip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ArspmController extends Controller
{
    public function create()
    {

        return view('admin.arsip.arsip_spm.spm_arsip_form');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama'          => 'required|string|max:255',
            'nomor_arsip'   => 'required|unique:spm_arsips,nomor_arsip',
            'tanggal'       => 'required|date',
            'jenis'         => 'required|in:GU,TU,UP,LS',
            'keterangan'    => 'required|string',
            'user_id'       => 'nullable|exists:users,id',
            'file'          => 'required|mimes:pdf,doc,docx,xlsx|max:10240',
        ]);

        $userId = Auth::id();

        $file = $request->file('file');
        $path = $request->jenis . "_" . time()  . "." . $file->getClientOriginalExtension();

        Storage::disk("local")->put("public/spm/" . $path, file_get_contents($file));

        // Simpan data
        $spm = SpmArsip::create([
            'nama'          => $request->nama,
            'nomor_arsip'   => $request->nomor_arsip,
            'tanggal'       => $request->tanggal,
            'path'          => $path,
            'jenis'         => $request->jenis,
            'keterangan'    => $request->keterangan,
            'user_id'       => $userId,
        ]);

        $spm->save();
        // return dd($validate);
        return back()->with('success', 'Berhasil mengupload berkas');
    }
}
