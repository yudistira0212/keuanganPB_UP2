<?php

namespace App\Http\Controllers;

use App\Models\Sp2dArsip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Arsp2dController extends Controller
{
    public function index()
    {
        $sp2dArsip = Sp2dArsip::all();
        return view('admin.arsip.arsip_sp2d.arsip_sp2d', compact('sp2dArsip'));
    }

    public function create()
    {

        return view('admin.arsip.arsip_sp2d.sp2d_form');
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'nama'          => 'required|string',
            'nomor_arsip'   => 'required|unique:sp2d_arsips|string',
            'tanggal'       => 'required|date',
            'jenis'         => 'required|in:Penting,Biasa',
            'keterangan'    => 'nullable|string',
            'file'          => 'required|mimes:pdf,doc,docx,xlsx|max:10240',
        ]);

        $userId = Auth::id();

        $file = $request->file('file');
        $path = $request->jenis . "_" . time()  . "." . $file->getClientOriginalExtension();

        // Simpan file ke penyimpanan
        Storage::disk("local")->put("public/sp2d/" . $path, file_get_contents($file));

        // Simpan data ke database
        Sp2dArsip::create([
            'nama'          => $request->nama,
            'nomor_arsip'   => $request->nomor_arsip,
            'tanggal'       => $request->tanggal,
            'path'          => $path,
            'jenis'         => $request->jenis,
            'keterangan'    => $request->keterangan,
            'user_id'       => $userId,
        ]);

        return back()->with('success', 'Berhasil mengupload berkas');
    }

    public function downloadFile($id)
    {
        // Temukan file berdasarkan ID atau cara lain sesuai kebutuhan Anda
        $sp2d = Sp2dArsip::findOrFail($id);

        // Ambil path penyimpanan file
        $filePath = storage_path("app/public/sp2d/{$sp2d->path}");

        // Mendownload file menggunakan Laravel
        return response()->download($filePath, $sp2d->nama . '.' . File::extension($filePath));
    }

    public function deleteFile($id)
    {
        // Temukan file berdasarkan ID atau cara lain sesuai kebutuhan Anda
        $sp2d = Sp2dArsip::findOrFail($id);

        // Hapus file dari penyimpanan
        $filePath = storage_path("app/public/sp2d/{$sp2d->path}");
        File::delete($filePath);

        // Hapus data dari database
        $sp2d->delete();

        // Redirect atau kirim respons sesuai kebutuhan Anda
        return back()->with('success', 'File berhasil dihapus');
    }
}
