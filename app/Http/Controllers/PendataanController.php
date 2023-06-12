<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Harga;
use App\Models\Pendataan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;

class PendataanController extends Controller
{
    public function index(Request $request)
    {
        $pendataan = DB::table('pendataans')
            ->leftJoin('users as tabel_pelanggan', 'pendataans.id_pelanggan', '=', 'tabel_pelanggan.id')
            ->leftJoin('users as tabel_petugas', 'pendataans.id_petugas', '=', 'tabel_petugas.id')
            ->select("pendataans.*", 'tabel_petugas.nama as nama_petugas', 'tabel_pelanggan.nama as nama_pelanggan',)
            ->orderBy('status_pembayaran', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->get();
        //render view with posts
        return view('dashboard.pendataan.index', compact('pendataan'));
    }

    public function show(string $id): View
    {
        $pendataan = DB::table('pendataans')
            ->leftJoin('users as tabel_pelanggan', 'pendataans.id_pelanggan', '=', 'tabel_pelanggan.id')
            ->leftJoin('users as tabel_petugas', 'pendataans.id_petugas', '=', 'tabel_petugas.id')
            ->select("pendataans.*", 'tabel_petugas.nama as nama_petugas', 'tabel_pelanggan.nama as nama_pelanggan',)
            ->where('pendataans.id', $id)
            ->first();

        return view('dashboard.pendataan.show', [
            'pendataan' => $pendataan,
        ]);
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

        DB::table('pendataans')->where('id',$request->id)->update([
            'status_pembayaran' => $status,
        ]);

        return redirect()->route('pendataans.index')->with('success', 'Status berhasil diubah menjadi :' . $status . '.');
    }

    public function create(Request $request)
    {
        // $user = User::selectRaw('id')->where('id', $request)->first();

        $pelanggan = DB::table('users')
            ->where('role', '=', 'Pelanggan')
            ->select('id', 'nama')
            ->get();
        // dd($pelanggan);
        return view('dashboard.pendataan.create', [
            'pelanggan' => $pelanggan,

        ]);
    }

    public function store(Request $request)
    {
        //check data from last month
        $dataLastmonth = Pendataan::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)
            ->where('id_pelanggan', $request->id_pelanggan)->count();

        $dataThismonth = Pendataan::whereMonth('created_at', '=', Carbon::now()->month)
            ->where('id_pelanggan', $request->id_pelanggan)->count();

        //get last mont data
        $lastMonth = Pendataan::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)
            ->where('id_pelanggan', $request->id_pelanggan)
            ->first();

        //check data availability
        if ($dataLastmonth < 1) {
            return redirect()->route('pendataans.create')->with('error', 'Data bulan lalu tidak ditemukan.');
        }

        $meteranLastmonth = $lastMonth->nilai_meteran;
        $meteranThismonth = $request->nilai_meteran;

        //check data availability
        if ($dataLastmonth > 1) {
            return redirect()->route('pendataans.create')->with('error', 'Data bulan lalu lebih dari 1.');
        } elseif ($dataThismonth > 0) {
            return redirect()->route('pendataans.create')->with('error', 'Pendataan Bulan ini sudah dilakukan.');
        } elseif ($meteranThismonth < $meteranLastmonth) {
            return redirect()->route('pendataans.create')->with('error', new HtmlString('Data bulan ini (<strong>' . $meteranThismonth . '</strong>) lebih kecil dari bulan lalu (<strong>' . $meteranLastmonth . '</strong>)'));
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

        //check foto
        if ($request->file('foto') == "") {
            Pendataan::create([
                'id_petugas'     => $request->id_petugas,
                'id_pelanggan'     => $request->id_pelanggan,
                'nilai_meteran'   => $request->nilai_meteran,
                'foto_meteran'   => '',
                'total_penggunaan'   => $meteran,
                'total_harga'   => $total_harga,
                'status_pembayaran'   => 'Tertunggak',
            ]);
        } else {

            //upload image
            $imageName = 'Plg' . $request->id_pelanggan . '-' . time() . '.' . $request->foto->extension();
            $image = $request->file('foto');
            $image->storeAs('public/foto/pendataan/', $imageName);

            //create data
            Pendataan::create([
                'id_petugas'     => '1',
                'id_pelanggan'     => $request->id_pelanggan,
                'nilai_meteran'   => $request->nilai_meteran,
                'foto_meteran'   => $imageName,
                'total_penggunaan'   => $meteran,
                'total_harga'   => $total_harga,
                'status_pembayaran'   => 'Tertunggak',
            ]);
        }

        return redirect()->route('pendataans.index')->with('success', 'Pendataan berhasil ditambah.');
    }

    public function edit(Pendataan $pendataan)
    {
        $pelanggan = DB::table('users')
            ->where('id', '=', $pendataan->id_pelanggan)
            ->select('id', 'nama')
            ->first();
        $petugas = DB::table('users')
            ->where('id', '=', $pendataan->id_petugas)
            ->select('id', 'nama')
            ->first();
        return view('dashboard.pendataan.edit', [
            'pendataan' => $pendataan,
            'pelanggan' => $pelanggan,
            'petugas' => $petugas,
        ]);
    }

    public function update(Request $request, Pendataan $pendataan)
    {
        //validate form
        // $this->validate($request, [
        //     'id_petugas'     => 'required',
        //     'id_pelanggan'     => 'required',
        //     'nilai_meteran'   => 'required',
        //     'foto_meteran'   => 'required',
        //     'total_harga'   => 'required',
        //     'status_pembayaran'   => 'required',
        // ]);

        if ($request->nilai_meteran != $pendataan->nilai_meteran) {
            //get last mont data
            $lastMonth = DB::table('pendataans')->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)
                ->where('id_pelanggan', $request->id_pelanggan)
                ->first();

            $meteranLastmonth = $lastMonth->nilai_meteran;
            $meteranThismonth = $request->nilai_meteran;

            $meteran = $meteranThismonth - $meteranLastmonth;

            if ($meteranThismonth < $meteranLastmonth) {
                return redirect()->route('pendataans.edit', $pendataan->id)->with('error', new HtmlString('Data bulan ini (<strong>' . $meteranThismonth . '</strong>) lebih kecil dari bulan lalu (<strong>' . $meteranLastmonth . '</strong>)'));
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
        if ($request->file('foto') == "") {
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
            $imageName = 'Plg' . $request->id_pelanggan . '-' . time() . '.' . $request->foto->extension();
            $image = $request->file('foto');
            $image->storeAs('public/foto/pendataan/', $imageName);

            //update data
            $pendataan->update([
                'nilai_meteran'   => $request->nilai_meteran,
                'total_harga'   => $total_harga,
                'status_pembayaran'   => $request->status_pembayaran,
                'foto_meteran'   => $imageName,
            ]);
        }


        //kembali
        return redirect()->route('pendataans.index')->with(['success' => 'Pendataan berhasil diubah.']);
    }

    public function destroy(Pendataan $pendataan)
    {
        //hapus old image
        Storage::disk('local')->delete('public/foto/pendataan/' . $pendataan->foto_meteran);
        Pendataan::destroy($pendataan->id);

        return redirect()->route('pendataans.index')->with('success', 'Data berhasil dihapus.');
    }
}
