<?php

namespace App\Http\Controllers;

use App\Models\SppArsip;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ArsppController extends Controller
{
    public function create()
    {

        return view('admin.arsip.arsip_spp.spp_arsip_form');
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'nama'          => 'required|string',
            'nomor_arsip'   => 'required|unique:spp_arsips|string',
            'tanggal'       => 'required|date',
            'jenis'         => 'required|in:LS,TUP,UP',
            'keterangan'    => 'nullable|string',
            'file'          => 'required|mimes:pdf,doc,docx,xlsx|max:10240',
        ]);

        $userId = Auth::id();

        $file = $request->file('file');
        $path = $request->jenis . "_" . time()  . "." . $file->getClientOriginalExtension();

        Storage::disk("local")->put("public/spp/" . $path, file_get_contents($file));
        $spp = SppArsip::create([
            'nama'          => $request->nama,
            'nomor_arsip'   => $request->nomor_arsip,
            'tanggal'       => $request->tanggal,
            'path'          => $path,
            'jenis'         => $request->jenis,
            'keterangan'    => $request->keterangan,
            'user_id'       => $userId,
        ]);

        $spp->save();

        return back()->with('success', 'Berhasil mengupload berkas');
    }

    public function downloadFile($id)
    {
        // Temukan file berdasarkan ID atau cara lain sesuai kebutuhan Anda
        $spp = SppArsip::findOrFail($id);

        // Ambil path penyimpanan file
        $filePath = storage_path("app/public/spp/{$spp->path}");

        // Mendownload file menggunakan Laravel
        return response()->download($filePath, $spp->nama . '.' . File::extension($filePath));
    }

    public function deleteFile($id)
    {
        // Temukan file berdasarkan ID atau cara lain sesuai kebutuhan Anda
        $spp = SppArsip::findOrFail($id);

        // Hapus file dari penyimpanan
        $filePath = storage_path("app/public/spp/{$spp->path}");
        File::delete($filePath);

        // Hapus data dari database
        $spp->delete();

        // Redirect atau kirim respons sesuai kebutuhan Anda
        return back()->with('success', 'File berhasil dihapus');
    }
}
