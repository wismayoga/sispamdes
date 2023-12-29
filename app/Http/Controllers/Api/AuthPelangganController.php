<?php

namespace App\Http\Controllers\api;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthPelangganController extends Controller
{
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required',
    //         'password' => 'required'
    //     ]);

    //     $user = User::where('email', $request->email)->first();

    //     if (! $user || ! Hash::check($request->password, $user->password)) {
    //         throw ValidationException::withMessages([
    //             'email' => ['The provided credentials are incorrect.'],
    //         ]);
    //     }

    //     return $user->createToken('user login')->plainTextToken;
    // }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        // dd($user);


        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'meta' => [
                    'code' => 401,
                    'status' => 'error',
                    'message' => 'The provided credentials are incorrect.'
                ]
            ]);
        }

        // // Check if the user has the role "Admin" or "Petugas"
        // if ($user->role !== 'Admin' || $user->role !== 'Petugas' ) {
        //     return response()->json([
        //         'meta' => [
        //             'code' => 401,
        //             'status' => 'error',
        //             'message' => 'Access denied. You do not have the required role to login.'
        //         ]
        //     ]);
        // }

        $accessToken = $user->createToken('user login')->plainTextToken;

        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Authenticated'
            ],
            'data' => [
                'id' => $user->id,
                'role' => $user->role,
                'email' => $user->email,
                'email_verified_at' => $user->email_verified_at,
                'nama' => $user->nama,
                'status' => $user->status,
                // 'foto_profil' => asset('storage/foto/profil/' . $user->foto_profil),
                'foto_profil' => 'http://10.0.2.2/sispamdes2/public/storage/foto/profil/' . $user->foto_profil,
                // 'foto_profil' => 'http://sispamdes.my.id/storage/foto/profil/' . $user->foto_profil,
                'nomor_hp' => $user->nomor_hp,
                'alamat' => $user->alamat,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                'role' => $user->role,
                'access_token' => $accessToken,
                'token_type' => 'Bearer',
            ]
        ]);
    }

    public function getUser()
    {
        $user = Auth::user();
        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Authenticated'
            ],
            'data' => [
                'id' => $user->id,
                'role' => $user->role,
                'email' => $user->email,
                'email_verified_at' => $user->email_verified_at,
                'nama' => $user->nama,
                'status' => $user->status,
                // 'foto_profil' => asset('storage/foto/profil/' . $user->foto_profil),
                'foto_profil' => 'http://10.0.2.2/sispamdes2/public/storage/foto/profil/' . $user->foto_profil,
                // 'foto_profil' => 'http://sispamdes.my.id/storage/foto/profil/' . $user->foto_profil,
                'nomor_hp' => $user->nomor_hp,
                'alamat' => $user->alamat,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                'role' => $user->role,
                'token_type' => 'Bearer',
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['success' => 'Berhasil logout.'], 200);
    }
}
