<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('dashboard.profil.index', ['user' => $user]);
    }

    public function edit()
    {
        $user = Auth::user();
        return view('dashboard.profil.edit', ['user' => $user]);
    }

    public function update(Request $request)
    {
        // dd($request);
        $user_id = Auth::user()->id;
        $user = User::where('id', '=', $user_id)->first();

        //jika tidak upload photo
        if ($request->file('foto') == null) {
            $user->update([
                'nama'   => $request->nama,
                'email'   => $request->email,
                'nomor_hp'   => $request->nomor_hp,
                'alamat'   => $request->alamat,
            ]);
        } else {

            //hapus old image
            Storage::disk('local')->delete('public/foto/profil/' . $user->foto_profil);

            //upload new image
            $imageName = 'Profil' . $user_id . '-' . time() . '.' . $request->foto->extension();
            $image = $request->file('foto');
            $image->storeAs('public/foto/profil/', $imageName);

            //update data
            $user->update([
                'nama'   => $request->nama,
                'email'   => $request->email,
                'nomor_hp'   => $request->nomor_hp,
                'alamat'   => $request->alamat,
                'foto_profil'   => $imageName,
            ]);
        }
        return redirect('profile')->with('success', 'Data berhasil ditambahkan !');
    }

    public function changePassword()
    {
        $user = Auth::user();
        return view('dashboard.profil.password', ['user' => $user]);
    }

    public function updatePassword(Request $request)
{
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Password lama tidak sesuai.");
        }

        if($request->new_password != $request->new_password_confirmation){
            return back()->with("error", "Pengulangan password baru tidak sesuai.");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect('profile')->with("success", "Password berhasil diubah.");
}

}
