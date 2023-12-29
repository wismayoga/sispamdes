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
use Illuminate\Support\Facades\Auth;

class PendataanController extends Controller
{
    public function index()
    {
        //get pendataan
        $pendataans = Pendataan::orderBy('created_at', 'ASC')->get();

        // Initialize an empty array to store the transformed data
        $responseData = [];

        // Loop through each pendataan and create a JSON structure for it
        foreach ($pendataans as $pendataan) {
            $pendataanData = [
                "id" => $pendataan->id,
                "id_petugas" => $pendataan->id_petugas,
                "id_pelanggan" => $pendataan->id_pelanggan,
                "nilai_meteran" => $pendataan->nilai_meteran,
                "foto_meteran" => $pendataan->foto_meteran,
                "total_penggunaan" => $pendataan->total_penggunaan,
                "total_harga" => $pendataan->total_harga,
                "status_pembayaran" => $pendataan->status_pembayaran,
                "created_at" => $pendataan->created_at,
                "updated_at" => $pendataan->updated_at,
            ];

            // Add the pendataan data to the response array
            $responseData[] = $pendataanData;
        }

        // Create the final response array
        $response = [
            "success" => true,
            "message" => "List Data Pendataan",
            "data" => $responseData,
        ];

        // Return the response as JSON
        return response()->json($response);
    }

    public function getPendataanById()
    {
        //get pendataan
        $user = Auth::user();
        $pendataans = Pendataan::orderBy('created_at', 'ASC')
            ->where('id_pelanggan', $user->id)
            ->get();

        //return collection of pendataans as a resource
        return new PendataanResource(true, 'List Data Pendataan By ID', $pendataans);
    }

    public function getHarga()
    {
        //get pendataan
        $harga = Harga::get();

        //return collection of pendataans as a resource
        return new PendataanResource(true, 'List Harga', $harga);
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


        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $currentDate = Carbon::now()->startOfMonth();
        $foundData = false;
        $lastMonthData = null;

        // Start from the previous month
        $date = $currentDate->subMonth();

        while (!$foundData && $date->year >= $currentYear) {
            $dataLastmonthcheck = Pendataan::whereMonth('created_at', '=', $date->month)
                ->whereYear('created_at', '=', $date->year)
                ->where('id_pelanggan', $request->id_pelanggan)
                ->first();

            if ($dataLastmonthcheck) {
                $foundData = true;
            }

            // Move to the previous month
            $date->subMonth();
        }

        if (!$foundData) {
            $dataLastmonth = 0;
        } else {
            $dataLastmonth = $dataLastmonthcheck->nilai_meteran;
        }

        $dataThismonth = Pendataan::whereMonth('created_at', '=', Carbon::now()->month)
            ->where('id_pelanggan', $request->id_pelanggan)->first();

        $meteranLastmonth = $dataLastmonth;
        $meteranThismonth = $request->nilai_meteran;

        //check data availability
        // if ($dataThismonth > 0) {
        //     return response()->json(['error' => 'Data bulan ini sudah dilakukan.'], 422);
        // } else
        if ($meteranThismonth < $meteranLastmonth) {
            // return response()->json(['error' => 'Data bulan ini lebih kecil dari bulan lalu.'], 423);
            return response()->json(['message' => 'Data skipped because current month meter reading is less than previous month.'], 200);
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

        if ($dataThismonth) {
            // If data exists, update it instead of creating a new entry
            $dataThismonth->update([
                'nilai_meteran' => $request->nilai_meteran,
                'foto_meteran' => $imageName,
                'total_penggunaan' => $meteran,
                'total_harga' => $total_harga,
                'status_pembayaran' => 'Tertunggak',
            ]);

            $dataThismonth = $dataThismonth->fresh();

            // Return response with updated data
            return new PendataanResource(true, 'Data berhasil diperbarui.', $dataThismonth);
        } else {


            // create data
            $pendataan = Pendataan::create([
                'id_petugas' => $request->id_petugas,
                'id_pelanggan' => $request->id_pelanggan,
                'nilai_meteran' => $request->nilai_meteran,
                'foto_meteran' => $imageName,
                'total_penggunaan' => $meteran,
                'total_harga' => $total_harga,
                'status_pembayaran' => 'Tertunggak',
            ]);

            //return response
            return new PendataanResource(true, 'Pendataan berhasil dibuat.', $pendataan);
        }
    }

    public function show(Pendataan $pendataan)
    {
        //return single post as a resource
        return new PendataanResource(true, 'Pendataan Ditemukan.', $pendataan);
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
        return new PendataanResource(true, 'Pendataan berhasil diubah.', $pendataan);
    }

    public function status(Request $request)
    {

        $pendataan = DB::table('pendataans')->where('id', $request->id)->first();
        $status = "";
        //update data
        if ($pendataan->status_pembayaran == 'Tertunggak') {
            $status = "Lunas";
        } else {
            $status = "Tertunggak";
        }

        DB::table('pendataans')->where('id', $request->id)->update([
            'status_pembayaran' => $status,
        ]);

        return new PendataanResource(true, 'Status pendataan berhasil diubah.', $pendataan);
    }

    public function destroy(Pendataan $pendataan)
    {
        //hapus old image
        Storage::disk('local')->delete('public/foto/pendataan/' . $pendataan->foto_meteran);
        // Pendataan::destroy($pendataan->id);
        $pendataan->delete();

        //return response
        return new PendataanResource(true, 'Pendataan berhasil dihapus.', null);
    }
}
