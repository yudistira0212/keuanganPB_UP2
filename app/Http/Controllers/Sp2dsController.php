<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sp2d;
use App\Models\Skpd;
use App\Models\Ttd;
use App\Models\Keperluan;
use App\Models\Potongan;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class Sp2dsController extends Controller
{
    /* ******************************************** */
    /* ******************* view ******************* */
    /* ******************************************** */

    public function index()
    {
        $sp2d = Sp2d::whereHas('permintaanSp2d', function ($query) {
            $query->where('status', 'selesai');
        })->get();
        // $sp2d = Sp2d::all();

        return view('admin.sp2d', ['data' => $sp2d]);
    }



    public function view(Sp2d $sp2d)
    {

        function terbilang($nominal)
        {
            $angka = array(
                0   => '',
                1   => 'satu',
                2   => 'dua',
                3   => 'tiga',
                4   => 'empat',
                5   => 'lima',
                6   => 'enam',
                7   => 'tujuh',
                8   => 'delapan',
                9   => 'sembilan',
                10  => 'sepuluh',
                11  => 'sebelas',
                20  => 'dua puluh',
                30  => 'tiga puluh',
                40  => 'empat puluh',
                50  => 'lima puluh',
                60  => 'enam puluh',
                70  => 'tujuh puluh',
                80  => 'delapan puluh',
                90  => 'sembilan puluh'
            );

            $bilangan = "";

            if ($nominal < 12) {
                $bilangan = $angka[$nominal];
            } elseif ($nominal < 20) {
                $bilangan = $angka[$nominal - 10] . " belas";
            } elseif ($nominal < 100) {
                $bilangan = $angka[$nominal - $nominal % 10] . " " . $angka[$nominal % 10];
            } elseif ($nominal < 200) {
                $bilangan = "seratus " . terbilang($nominal - 100);
            } elseif ($nominal < 1000) {
                $bilangan = $angka[(int)($nominal / 100)] . " ratus " . terbilang($nominal % 100);
            } elseif ($nominal < 2000) {
                $bilangan = "seribu " . terbilang($nominal - 1000);
            } elseif ($nominal < 1000000) {
                $bilangan = terbilang((int)($nominal / 1000)) . " ribu " . terbilang($nominal % 1000);
            } elseif ($nominal < 1000000000) {
                $bilangan = terbilang((int)($nominal / 1000000)) . " juta " . terbilang($nominal % 1000000);
            } elseif ($nominal < 1000000000000) {
                $bilangan = terbilang((int)($nominal / 1000000000)) . " miliar " . terbilang($nominal % 1000000000);
            } else {
                $bilangan = "Angka terlalu besar";
            }

            return $bilangan;
        }

        $terbilang = terbilang($sp2d->jumlah_uang);

        return view('admin.sp2d.tampil-surat', compact('sp2d', 'terbilang'));
    }

    public function editView($id)
    {
        $sp2d   = Sp2d::find($id);
        $skpd   = Skpd::all();
        $ttd    = Ttd::all();
        return view('admin.sp2d.edit-sp2d', compact('sp2d', 'skpd', 'ttd'));
    }

    public function create()
    {
        $skpd   = Skpd::all();
        $ttd    = Ttd::all();

        return view('admin.sp2d.form-sp2d', ['data' => $skpd], ['TTD' => $ttd]);
    }


    /* ************************************************ */
    /* ******************* end view ******************* */
    /* ************************************************ */



    /* ******************************************** */
    /* ****************** store ******************* */
    /* ******************************************** */
    public function store(Request $request)
    {
        $request->validate([
            'no_spm'                                => 'required',
            'tanggal_sp2ds'                         => 'required|date',
            'nomorSurat'                            => 'required',
            'tanggaran'                             => 'required|numeric',
            'bank_pos'                              => 'required',
            'no_surat'                              => 'nullable|string|unique:sp2ds,no_surat',
            'no_rek_keuangan'                       => 'nullable|string',
            'bank_pos_keuangan'                     => 'nullable|string',
            'no_rek'                                => 'required|numeric',
            'jumlah_uang'                           => 'required|numeric',
            'kepada'                                => 'required',
            'npwp'                                  => 'required|string',
            'keperluann'                            => 'required',
            'ttd'                                   => 'required',
            'dinas_skpd'                            => 'required',
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

        $uiserId                = Auth::id();
        $data_uraian_keperluan  = $request->input('data_uraian_keperluan');
        $data_potongan          = $request->input('data_potongan');
        $data_informasi         = $request->input('data_informasi');


        $sp2d =  Sp2d::create(
            [
                'no_spm'            => $request->no_spm,
                'tgl_sp2d'          => $request->tanggal_sp2ds,
                'no_surat'          => $request->nomorSurat,
                'dari'              => $request->nomorSurat,
                'tahun_anggaran'    => $request->tanggaran,
                'no_rek_keuangan'   => $request->no_rek_keuangan,
                'bank_pos_keuangan' => $request->bank_pos_keuangan,
                'bank_pos'          => $request->bank_pos,
                'rekening'          => $request->no_rek,
                'jumlah_uang'       => $request->jumlah_uang,
                'kepada'            => $request->kepada,
                'npwp'              => $request->npwp,
                'keperluan'         => $request->keperluann,
                'user_id'           => $uiserId,
                'ttd_id'            => $request->ttd,
                'skpd_id'           => $request->dinas_skpd
            ]
        );


        if (!empty($data_uraian_keperluan)) {
            foreach ($data_uraian_keperluan as $index => $data) {
                $sp2d->keperluann()->create([
                    'kode_rekening' => $data['kode_rekening'],
                    'uraian'        => $data['uraian'],
                    'jumlah'        => $data['jumlah'],
                ]);
            }
        }

        // Validasi untuk $data_potongan
        if (!empty($data_potongan)) {
            foreach ($data_potongan as $index => $data) {
                $sp2d->sp2d()->potongan()->create([
                    'no_rekening'   => $data['no_rekening'],
                    'jumlah'        => $data['jumlah'],
                    'keterangan'    => $data['keterangan'],
                ]);
            }
        }

        // Validasi untuk $data_informasi
        if (!empty($data_informasi)) {
            foreach ($data_informasi as $index => $data) {
                $sp2d->informasi()->create([
                    'no_rekening'   => $data['no_rekening'],
                    'jumlah'        => $data['jumlah'],
                    'keterangan'    => $data['keterangan'],
                ]);
            }
        }

        $sp2d->save();

        return Redirect::route('SP2D')->with('success', 'SP2D Berhasil Di buat');
    }

    /************************************************** */
    /* ******************* end store ******************* */
    /* ************************************************ */


    /* ******************************************** */
    /* ****************** update ****************** */
    /* ******************************************** */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'no_spm'                                => 'required',
            // 'tanggal_sp2ds'                         => 'required|date',
            'nomorSurat'                            => 'required',
            'tanggaran'                             => 'required|numeric',
            'bank_pos'                              => 'required',
            'no_surat'                              => 'string|unique:sp2ds,no_surat',
            'no_rek_keuangan'                       => 'required',
            'bank_pos_keuangan'                     => 'required',
            'no_rek'                                => 'required|numeric',
            'jumlah_uang'                           => 'required|numeric',
            'kepada'                                => 'required',
            'npwp'                                  => 'required',
            'keperluann'                            => 'required',
            'ttd'                                   => 'required',
            'dinas_skpd'                            => 'required',
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

            $uiserId                = Auth::id();
            $data_uraian_keperluan  = $request->input('data_uraian_keperluan');
            $data_potongan          = $request->input('data_potongan');
            $data_informasi         = $request->input('data_informasi');

            // Menggunakan metode findOrFail untuk menemukan dan mengupdate data yang sudah ada
            $sp2d = Sp2d::findOrFail($id);

            $sp2d->update([
                'no_spm'            => $request->no_spm,
                'tgl_sp2d'          => $request->tanggal_sp2ds,
                'no_surat'          => $request->nomorSurat,
                'dari'              => $request->nomorSurat,
                'tahun_anggaran'    => $request->tanggaran,
                'no_rek_keuangan'   => $request->no_rek_keuangan,
                'bank_pos_keuangan' => $request->bank_pos_keuangan,
                'bank_pos'          => $request->bank_pos,
                'rekening'          => $request->no_rek,
                'jumlah_uang'       => $request->jumlah_uang,
                'kepada'            => $request->kepada,
                'npwp'              => $request->npwp,
                'keperluan'         => $request->keperluann,
                'user_id'           => $uiserId,
                'ttd_id'            => $request->ttd,
                'skpd_id'           => $request->dinas_skpd
            ]);

            // Menghapus data yang ada terkait dengan ID sp2d
            $sp2d->keperluann()->delete();
            $sp2d->potongan()->delete();

            // Menambahkan data yang baru
            if (!empty($data_uraian_keperluan)) {
                foreach ($data_uraian_keperluan as $index => $data) {
                    $sp2d->keperluann()->create([
                        'kode_rekening' => $data['kode_rekening'],
                        'uraian'        => $data['uraian'],
                        'jumlah'        => $data['jumlah'],
                    ]);
                }
            }

            // Validasi untuk $data_potongan
            if (!empty($data_potongan)) {
                foreach ($data_potongan as $index => $data) {
                    $sp2d->potongan()->create([
                        'no_rekening'   => $data['no_rekening'],
                        'jumlah'        => $data['jumlah'],
                        'keterangan'    => $data['keterangan'],
                    ]);
                }
            }

            // Validasi untuk $data_informasi
            if (!empty($data_informasi)) {
                foreach ($data_informasi as $index => $data) {
                    $sp2d->informasi()->create([
                        'no_rekening'   => $data['no_rekening'],
                        'jumlah'        => $data['jumlah'],
                        'keterangan'    => $data['keterangan'],
                    ]);
                }
            }

            if (
                // !empty($sp2d->no_spm) &&
                // !empty($sp2d->tgl_sp2d) &&
                // !empty($sp2d->no_surat) &&
                // !empty($sp2d->dari) &&
                // !empty($sp2d->tahun_anggaran) &&
                // !empty($sp2d->no_rek_keuangan) &&
                // !empty($sp2d->bank_pos_keuangan) &&
                // !empty($sp2d->bank_pos) &&
                // !empty($sp2d->rekening) &&
                // !empty($sp2d->jumlah_uang) &&
                // !empty($sp2d->kepada) &&
                // !empty($sp2d->npwp) &&
                // !empty($sp2d->keperluan) &&
                // !empty($sp2d->user_id) &&
                // !empty($sp2d->ttd_id)
                // !empty($sp2d->skpd_id)
                $sp2d->permintaanSp2d->status == 'proses'
            ) {
                $sp2d->permintaanSp2d->status = 'selesai';
            }
            // $sp2d->permintaanSp2d->
            $sp2d->permintaanSp2d->save();
            $sp2d->save();


            return Redirect::route('SP2D')->with('success', 'SP2D Berhasil Di Update');
        } catch (\Throwable $th) {
            return dd('error' . $th->getMessage());
        }
    }

    /* ************************************************ */
    /* ****************** end update ****************** */
    /* ************************************************ */

    /* ********************************************** */
    /* ******************* delete ******************* */
    /* ********************************************** */
    public function delete($id)
    {
        try {
            // Menggunakan metode findOrFail untuk menemukan dan menghapus data
            $sp2d = Sp2d::findOrFail($id);

            // Hapus data terkait
            $sp2d->keperluann()->delete();
            $sp2d->potongan()->delete();

            // Hapus data utama
            $sp2d->delete();

            // Redirect ke halaman tertentu setelah berhasil menghapus
            return Redirect::route('SP2D')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Tangani kesalahan jika data tidak ditemukan atau terjadi kesalahan lainnya
            return Redirect::route('SP2D')->with('error', 'Gagal menghapus data');
        }
    }

    /* ************************************************** */
    /* ******************* end delete ******************* */
    /* ************************************************** */
}
