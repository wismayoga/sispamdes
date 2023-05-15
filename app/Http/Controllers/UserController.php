<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        //get posts
        $users = User::paginate(10);

        //render view with posts
        return view('dashboard.user.index', compact('users'));
        // return view('dashboard.harga.edit', ['harga' => $harga]);
        
    }

    public function edit(User $user)
    {
        //
        // return view('dashboard.harga.edit', compact('harga'));
        return view('dashboard.user.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        //validate form
        $this->validate($request, [
            'role'     => 'required',
            'nama'     => 'required',
            'email'   => 'required',
            'nomor_hp'   => 'required',
            'status'   => 'required',
        ]);
        
        // dd($request);

        //update harga
        $user->update([
            'nama'     => $request->nama,
            'role'   => $request->role,
            'email'   => $request->email,
            'nomor_hp'     => $request->nomor_hp,
            'alamat'   => $request->alamat,
            'status'   => $request->status,
        ]);

        //kembali
        return redirect()->route('users.index')->with(['success' => 'Harga Berhasil Diubah!']);
        
    }

}
