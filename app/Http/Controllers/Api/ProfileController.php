<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        //get data user yang login
        $user = Auth::user();

        //return collection of user as a resource
        return new ProfileResource(true, 'Data User', $user);
    }

    public function update(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'nama'     => 'required',
        //     'email'     => 'required',
        //     'nomor_hp'   => 'required',
        //     'alamat'   => 'required',
        // ]);

        $user = Auth::user();

        //jika tidak upload photo
        if ($request->file('foto_profil') == null) {
            DB::table('users')->where('id', $user->id)->update([
                'nama'   => $request->nama,
                'nomor_hp'   => $request->nomor_hp,
                'alamat'   => $request->alamat,
            ]);
        } else {

            //hapus old image
            Storage::disk('local')->delete('public/foto/profil/' . $user->foto_profil);

            //upload new image
            $imageName = 'Profil' . $user->id . '-' . time() . '.' . $request->foto_profil->extension();
            $image = $request->file('foto_profil');
            $image->storeAs('public/foto/profil/', $imageName);

            //update data
            DB::table('users')->where('id', $user->id)->update([
                'nama'   => $request->nama,
                'nomor_hp'   => $request->nomor_hp,
                'alamat'   => $request->alamat,
                'foto_profil'   => $imageName,
            ]);
        }

        $userUpdate = DB::table('users')->where('id', $user->id)->first();

        return new ProfileResource(true, 'Profil berhasil diubah.', $userUpdate);
    }

    public function updatePassword(Request $request)
    {
        // Validation
        // $validator = Validator::make($request->all(), [
        //     'old_password' => 'required',
        //     'new_password' => 'required',
        //     'new_password_confirm' => 'required',
        // ]);


        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return response()->json(['error' => 'Password lama tidak sesuai.'], 422);
        }

        if ($request->new_password != $request->new_password_confirm) {
            return response()->json(['error' => 'Pengulangan password baru tidak sesuai.'], 422);
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json(['success' => 'Password berhasil diubah.'], 200);
    }

    public function updateFoto(Request $request)
    {
        $user = Auth::user();
        //upload new image
        $image = $request->file('foto_profil');
        $extension = $image->getClientOriginalExtension();
        // $extension = $image->extension();
        $imageName = 'Profil' . $user->id . '-' . time() . '.' . $extension;
        // $imageName = 'Profil' . $user->id . '-' . time() . '.' . $request->foto_profil->getClientOriginalExtension();
        

        //hapus old image
        Storage::disk('local')->delete('public/foto/profil/' . $user->foto_profil);

        
        
        $image->storeAs('public/foto/profil/', $imageName);


        //update data
        User::whereId(auth()->user()->id)->update([
            'foto_profil'   => $imageName,
        ]);

        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Authenticated'
            ],
            'data' => [
                // 'foto_profil' => asset('storage/foto/profil/' . $user->foto_profil),
                'foto_profil' => 'http://10.0.2.2/sispamdes2/public/storage/foto/profil/' . $imageName,
                // 'foto_profil' => 'http://sispamdes.my.id/storage/foto/profil/' . $imageName,
            ]
        ]);
    }
}
