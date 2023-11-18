<?php

namespace App\Http\Controllers;

use App\Models\Skpd;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdministratorController extends Controller
{
    public function index()
    {

        $data = User::all();
        $user = Auth::user()->name;


        return view('admin.Users.administrator', ['data' => $data], ['users' => $user]);
    }
    public function create()
    {
        $skpd = Skpd::all();
        return view('admin.Users.register', compact('skpd'));
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'max:255'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            // 'skpd_id' => $request->skpd_id,
        ]);

        return Redirect::route('Administrator')->with('success', 'User Berhasil dibuat');
    }
}
