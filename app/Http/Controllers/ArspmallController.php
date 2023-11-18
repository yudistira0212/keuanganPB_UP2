<?php

namespace App\Http\Controllers;

use App\Models\SpmArsip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ArspmallController extends Controller
{
    public function index()
    {
        $userID = Auth::id();
        $ArsipSpm = SpmArsip::where('user_id', $userID)->get();
        return view('admin.arsip.arsip_spm.arsip_spm_all', compact('ArsipSpm'));
    }

    public function deleteFile($id)
    {
        // Temukan file berdasarkan ID atau cara lain sesuai kebutuhan Anda
        $file = SpmArsip::findOrFail($id);

        // Hapus file dari penyimpanan
        $filePath = storage_path("app/public/spm/{$file->path}");
        File::delete($filePath);

        // Hapus data dari database
        $file->delete();

        // Redirect atau kirim respons sesuai kebutuhan Anda
        return redirect()->route('arspm-all')->with('success', 'File berhasil dihapus');
    }
}
