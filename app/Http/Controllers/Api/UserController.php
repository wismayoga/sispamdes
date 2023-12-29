<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        //get posts
        $users = User::where('role', 'pelanggan')
        ->where('status', 'Aktif')
        ->get();

        //return collection of posts as a resource
        return new UserResource(true, 'List Data User', $users);
    }

    public function show(User $user)
    {
        //return single post as a resource
        return new UserResource(true, 'User Ditemukan.', $user);
    }

    public function update(Request $request, User $user)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'role'     => 'required',
            'nama'     => 'required',
            'email'   => 'required',
            'nomor_hp'   => 'required',
            'status'   => 'required',
        ]);

        //update harga
        if($request->password == ''){
            $user->update([
                'nama'     => $request->nama,
                'role'   => $request->role,
                'email'   => $request->email,
                'nomor_hp'     => $request->nomor_hp,
                'alamat'   => $request->alamat,
                'status'   => $request->status,
            ]);
        }else{
            $user->update([
                'nama'     => $request->nama,
                'role'   => $request->role,
                'email'   => $request->email,
                'nomor_hp'     => $request->nomor_hp,
                'alamat'   => $request->alamat,
                'status'   => $request->status,
                'password'   => Hash::make($request->password),
            ]);
        }
        

        //return response
        return new UserResource(true, 'Pendataan berhasil diubah.', $user);
    }

    public function updatePelanggan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'id'     => 'required',
            'nomor_hp'   => 'required',
            'alamat'   => 'required',
        ]);

        
            DB::table('users')->where('id', $request->id)->update([
                'nama'   => $request->nama,
                'nomor_hp'   => $request->nomor_hp,
                'alamat'   => $request->alamat,
            ]);
        
        $userUpdate = DB::table('users')->where('id', $request->id)->first();

        return new UserResource(true, 'Biodata berhasil diubah.', $userUpdate);
    }
}
