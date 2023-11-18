<?php

namespace App\Http\Controllers;

use App\Models\Skpd;
use Illuminate\Http\Request;

class SkpdController extends Controller
{
    public function index()
    {
        $skpd = Skpd::all();
        return view("admin.skpd.skpd", compact('skpd'));
    }


    public function edit($id)
    {
        $skpd = Skpd::findOrFail($id);

        return view('admin.skpd.edit-skpd', compact('skpd'));
    }


    public function create()
    {
        return view('admin.skpd.form-skpd');
    }

    public function store(Request $request)
    {
        $userId = auth()->user()->id;
        $data = $request->validate([
            'dinas'    => 'required|string|max:255',
            'alamat'   => 'required|string|max:255',
            'kode_pos' => 'required|integer',

        ]);

        Skpd::create([
            'dinas' => $data['dinas'],
            'alamat' => $data['alamat'],
            'kode_pos' => $data['kode_pos'],
            'user_id' => $userId
        ]);

        return redirect()->route('skpd-view')->with('success', 'SKPD Berhasil Di Dambahkan');
    }



    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'dinas'    => 'required|string|max:255',
            'alamat'   => 'required|string|max:255',
            'kode_pos' => 'required|integer',
        ]);

        $skpd = Skpd::findOrFail($id);
        $skpd->update($data);

        return redirect()->route('skpd-view')->with('success', 'Data SKPD berhasil diperbarui');
    }

    public function destroy($id)
    {
        $skpd = Skpd::findOrFail($id);
        $skpd->delete();

        return redirect()->route('skpd-view')->with('success', 'Data SKPD berhasil dihapus');
    }
}
