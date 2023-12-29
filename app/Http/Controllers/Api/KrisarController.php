<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PengaduanResource;
use App\Models\Pendataan;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KrisarController extends Controller
{
    public function index()
    {
        //get pendataan
        $user = Auth::user();
        $krisar = Pengaduan::orderBy('created_at', 'ASC')
        ->where('id_pelanggan', $user->id)
        ->get();
        //return collection of pendataans as a resource
        return new PengaduanResource(true, 'List Data Krisar', $krisar);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto_pengaduan'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pengaduan'   => 'required',
        ]);


        $user = Auth::user();

        //jika tidak upload photo
        if ($request->file('foto_pengaduan') == null) {
            $pengaduan = Pengaduan::create([
                'id_pelanggan' => $user->id,
                'pengaduan' => $request->pengaduan,
                'status_pengaduan' => 'Belum Dilihat',
                'foto_pengaduan' => '',
            ]);
        } else {
            //upload new image
            $imageName = 'Pengaduan' . $user->id . time() . '.' . $request->foto_pengaduan->extension();
            $image = $request->file('foto_pengaduan');
            $image->storeAs('public/foto/pengaduan/', $imageName);

            //create data
            $pengaduan = Pengaduan::create([
                'id_pelanggan' => $user->id,
                'pengaduan' => $request->pengaduan,
                'status_pengaduan' => 'Belum Dilihat',
                'foto_pengaduan' => $imageName,
            ]);
        }

        return new PengaduanResource(true, 'Berhasil Dibuat.', $pengaduan);
    }

}
