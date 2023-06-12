<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PendataanResource;
use App\Models\Harga;
use App\Models\Pendataan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PendataanController extends Controller
{
    public function index()
    {
        //get posts
        $posts = Pendataan::latest()->paginate(5);

        //return collection of posts as a resource
        return new PendataanResource(true, 'List Data Posts', $posts);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'foto_meteran'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id_petugas'     => 'required',
            'id_pelanggan'   => 'required',
            'nilai_meteran'   => 'required',
        ]);

        //hitung data bulan lalu
        $dataLastmonth = Pendataan::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)
            ->where('id_pelanggan', $request->id_pelanggan)->count();

        //hitung data bulan ini
        $dataThismonth = Pendataan::whereMonth('created_at', '=', Carbon::now()->month)
            ->where('id_pelanggan', $request->id_pelanggan)->count();

        //get data bulan lalu
        $lastMonth = Pendataan::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)
            ->where('id_pelanggan', $request->id_pelanggan)
            ->first();

        //check data bulan lalu
        if ($dataLastmonth < 1) {
            return response()->json(['error' => 'Data bulan lalu tidak ditemukan.'], 422);
        }

        $meteranLastmonth = $lastMonth->nilai_meteran;
        $meteranThismonth = $request->nilai_meteran;

        //check data availability
        if ($dataLastmonth > 1) {
            return response()->json(['error' => 'Data bulan lalu lebih dari 1.'], 422);
        } elseif ($dataThismonth > 0) {
            return response()->json(['error' => 'Pendataan Bulan ini sudah dilakukan.'], 422);
        } elseif ($meteranThismonth < $meteranLastmonth) {
            return response()->json(['error' => 'Data bulan ini lebih kecil dari bulan lalu.'], 422);
        }

        //get level harga
        $harga = Harga::first();
        $level1 = $harga->level1;
        $level2 = $harga->level2;
        $level3 = $harga->level3;
        $meteran = $meteranThismonth - $meteranLastmonth;

        //harga air
        if ($meteran <= 20) {
            $total_harga = $meteran * $level1;
        } else if ($meteran > 20 && $meteran <= 40) {
            $harga1 = 20 * $level1;
            $meteran1 = $meteran - 20;
            $harga2 = $meteran1 * $level2;
            $total_harga = $harga1 + $harga2;
        } else {
            $harga1 = 20 * $level1;
            $harga2 = 20 * $level2;
            $meteran1 = $meteran - 40;
            $harga3 = $meteran1 * $level3;
            $total_harga = $harga1 + $harga2 + $harga3;
        }


        //upload image
        $imageName = 'Plg' . $request->id_pelanggan . '-' . time() . '.' . $request->foto_meteran->extension();
        $image = $request->file('foto_meteran');
        $image->storeAs('public/foto/pendataan/', $imageName);

        //create data
        $pendataan = Pendataan::create([
            'id_petugas'     => $request->id_petugas,
            'id_pelanggan'     => $request->id_pelanggan,
            'nilai_meteran'   => $request->nilai_meteran,
            'foto_meteran'   => $imageName,
            'total_penggunaan'   => $meteran,
            'total_harga'   => $total_harga,
            'status_pembayaran'   => 'Tertunggak',
        ]);

        //return response
        return new PendataanResource(true, 'Data Post Berhasil Ditambahkan!', $pendataan);
    }

    public function show(Pendataan $pendataan)
    {
        //return single post as a resource
        return new PendataanResource(true, 'Data Pendataan Ditemukan!', $pendataan);
    }

    public function update(Request $request, Pendataan $pendataan)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'foto_meteran'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id_petugas'     => 'required',
            'id_pelanggan'   => 'required',
            'nilai_meteran'   => 'required',
        ]);

        if ($request->nilai_meteran != $pendataan->nilai_meteran) {
            //get last mont data
            $lastMonth = DB::table('pendataans')->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)
                ->where('id_pelanggan', $request->id_pelanggan)
                ->first();
            
            //check data bulan lalu
            if ($lastMonth == null) {
                return response()->json(['error' => 'Data bulan lalu tidak ditemukan.'], 422);
            }

            $meteranLastmonth = $lastMonth->nilai_meteran;

            $meteranThismonth = $request->nilai_meteran;

            $meteran = $meteranThismonth - $meteranLastmonth;

            if ($meteranThismonth < $meteranLastmonth) {
                return response()->json(['error' => 'Data bulan ini lebih kecil dari bulan lalu.'], 422);
            }

            $harga = Harga::first();
            $level1 = $harga->level1;
            $level2 = $harga->level2;
            $level3 = $harga->level3;

            if ($meteran <= 20) {
                $total_harga = $meteran * $level1;
            } else if ($meteran > 20 && $meteran <= 40) {
                $harga1 = 20 * $level1;
                $meteran1 = $meteran - 20;
                $harga2 = $meteran1 * $level2;
                $total_harga = $harga1 + $harga2;
            } else {
                $harga1 = 20 * $level1;
                $harga2 = 20 * $level2;
                $meteran1 = $meteran - 40;
                $harga3 = $meteran1 * $level3;
                $total_harga = $harga1 + $harga2 + $harga3;
            }
        } else {
            $total_harga = $pendataan->total_harga;
            $meteran = $pendataan->total_penggunaan;
        }

        //jika tidak upload photo
        if ($request->file('foto_meteran') == "") {
            $pendataan->update([
                'nilai_meteran'   => $request->nilai_meteran,
                'total_penggunaan'   => $meteran,
                'total_harga'   => $total_harga,
                'status_pembayaran'   => $request->status_pembayaran,
            ]);
        } else {

            //hapus old image
            Storage::disk('local')->delete('public/foto/pendataan/' . $pendataan->foto_meteran);

            //upload new image
            $imageName = 'Plg' . $request->id_pelanggan . '-' . time() . '.' . $request->foto_meteran->extension();
            $image = $request->file('foto_meteran');
            $image->storeAs('public/foto/pendataan/', $imageName);

            //update data
            $pendataan->update([
                'nilai_meteran'   => $request->nilai_meteran,
                'total_harga'   => $total_harga,
                'status_pembayaran'   => $request->status_pembayaran,
                'foto_meteran'   => $imageName,
            ]);
        }

        //return response
        return new PendataanResource(true, 'Data Post Berhasil Diubah!', $pendataan);
    }

    public function destroy(Pendataan $pendataan)
    {
        //hapus old image
        Storage::disk('local')->delete('public/foto/pendataan/' . $pendataan->foto_meteran);
        // Pendataan::destroy($pendataan->id);
        $pendataan->delete();

        //return response
        return new PendataanResource(true, 'Data Post Berhasil Dihapus!', null);
    }
}
