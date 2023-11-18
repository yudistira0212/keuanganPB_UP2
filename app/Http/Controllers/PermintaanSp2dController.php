<?php

namespace App\Http\Controllers;

use App\Models\PermintaanSp2d;
use App\Models\Skpd;
use App\Models\Sp2d;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;

class PermintaanSp2dController extends Controller
{

    public function form()
    {
        return view('admin.sp2d.minta-sp2d');
    }

    public function list()
    {

        $data = PermintaanSp2d::all();

        return view('admin.sp2d.list_permintaan', compact('data'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'no_spm'                                => 'required',
            // 'tanggal_sp2ds'                         => 'required|date',
            // 'nomorSurat'                            => 'required',
            'tanggaran'                             => 'required|numeric',
            'bank'                                  => 'required',
            'no_rek'                                => 'required|numeric',
            'jumlah_uang'                           => 'required|numeric',
            'kepada'                                => 'required',
            'npwp'                                  => 'required|numeric',
            'keperluann'                            => 'required',
            // 'ttd'                                   => 'required',
            // 'dinas_skpd'                            => 'required',
            'data_uraian_keperluan.*.kode_rekening' => 'required',
            'data_uraian_keperluan.*.uraian'        => 'required',
            'data_uraian_keperluan.*.jumlah'        => 'required|numeric',
            // 'data_potongan.*.no_rekening'           => 'required',
            // 'data_potongan.*.jumlah'                => 'required|numeric',
            // 'data_potongan.*.keterangan'            => 'required',
            // 'data_informasi.*.no_rekening'          => 'required',
            // 'data_informasi.*.jumlah'               => 'required|numeric',
            // 'data_informasi.*.keterangan'           => 'required',
        ]);

        try {
            $userId = Auth::id();
            $dinasSkpd = Skpd::where('user_id', $userId)->first(); // Menggunakan first() untuk mendapatkan satu instans

            $data_uraian_keperluan = $request->input('data_uraian_keperluan');
            $data_potongan = $request->input('data_potongan');
            $data_informasi = $request->input('data_informasi');

            // $permintaanSp2d = PermintaanSp2d::all();


            $sp2d = Sp2d::create([
                'no_spm' => $request->no_spm,
                // 'tgl_sp2d' => $request->tanggal_sp2ds,
                'no_surat' => $request->nomorSurat,
                // 'dari' => $request->nomorSurat,
                'tahun_anggaran' => $request->tanggaran,
                'bank_pos' => $request->bank,
                'rekening' => $request->no_rek,
                'jumlah_uang' => $request->jumlah_uang,
                'kepada' => $request->kepada,
                'npwp' => $request->npwp,
                'keperluan' => $request->keperluann,
                'user_id' => $userId,
                'skpd_id' => $dinasSkpd->id,
            ]);



            if (!empty($data_uraian_keperluan)) {
                foreach ($data_uraian_keperluan as $index => $data) {
                    $sp2d->keperluann()->create([
                        'kode_rekening' => $data['kode_rekening'],
                        'uraian' => $data['uraian'],
                        'jumlah' => $data['jumlah'],
                    ]);
                }
            }

            if (!empty($data_potongan)) {
                foreach ($data_potongan as $index => $data) {
                    $sp2d->potongan()->create([
                        'no_rekening' => $data['no_rekening'],
                        'jumlah' => $data['jumlah'],
                        'keterangan' => $data['keterangan'],
                    ]);
                }
            }

            if (!empty($data_informasi)) {
                foreach ($data_informasi as $index => $data) {
                    $sp2d->informasi()->create([
                        'no_rekening' => $data['no_rekening'],
                        'jumlah' => $data['jumlah'],
                        'keterangan' => $data['keterangan'],
                    ]);
                }
            }


            $file = $request->file('file');
            $path = $request->kepada . "_" . time()  . "." . $file->getClientOriginalExtension();

            // Simpan file ke penyimpanan
            Storage::disk("local")->put("public/permintaan_sp2d/" . $path, file_get_contents($file));


            $permintaanSp2d = PermintaanSp2d::create([
                "path" => $path,
                "status" => "menunggu",
                "sp2d_id" => $sp2d->id,
                "tanggal" =>  $request->tanggal_sp2ds
            ]);

            $permintaanSp2d->save();
            $sp2d->save();

            return Redirect::route('listPermintaanSP2D')->with('success', 'SP2D Berhasil Di buat');
        } catch (\Throwable $th) {
            return dd('error' . $th->getMessage());
        }
    }

    public function updateStatus($id, $status)
    {
        $data = PermintaanSp2d::find($id);
        $data->status = $status;
        $data->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }

    public function downloadFile($id)
    {
        // Temukan file berdasarkan ID atau cara lain sesuai kebutuhan Anda
        $file = PermintaanSp2d::findOrFail($id);

        // Ambil path penyimpanan file
        $filePath = storage_path("app/public/permintaan_sp2d/{$file->path}");

        // Mendapatkan ekstensi file
        $extension = File::extension($filePath);

        // Mendownload file menggunakan Laravel
        return response()->download($filePath, $file->sp2d->skpd->dinas . '_' . 'spm' . '.' . $extension);
    }
}
