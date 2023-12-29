<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        //a Get data
        $jumlahUser = DB::table('users')->where('role', 'Pelanggan')->count();
        $jumlahPendataan = DB::table('pendataans')->whereMonth('created_at', '=', Carbon::now()->month)->count();
        $persentasiPendataan = $jumlahPendataan / $jumlahUser * 100;
        $persentasiPendataanBulat = number_format((float)$persentasiPendataan, 2, '.', '');
        $pendapatan = DB::table('pendataans')
            ->whereMonth('created_at', '=', Carbon::now()->month)
            ->where('status_pembayaran', 'Lunas')
            ->sum('total_harga');
        $pelangganAktif = DB::table('users')->where('status', 'Aktif')->where('role', 'Pelanggan')->count();
        $pelanggan = DB::table('users')->where('role', 'Pelanggan')->count();
        $krisar = DB::table('pengaduans')->where('status_pengaduan', 'Belum Dilihat')->count();
        $namabulan = Carbon::now()->translatedFormat('F Y');
        $now = Carbon::now();
        $dataBulanSebelumnya = [];


        //b perulangan 
        for ($i = 1; $i <= $now->month; $i++) {
            $bulan = $i;
            $tahun = $now->year;

            //c Mengambil data dari tabel "pendataan" berdasarkan bulan dan tahun
            $pendataan = DB::table('pendataans')
                ->where('status_pembayaran', 'Lunas')
                ->whereMonth('created_at', $bulan)
                ->whereYear('created_at', $tahun)
                ->get();

            //d Menyimpan data ke databulansebelumnya
            $dataBulanSebelumnya[] = [
                'bulan' => $bulan,
                'tahun' => $tahun,
                'pendataan' => $pendataan,
            ];
        }

        //e menghitung totalpenggunaan
        $totalPenggunaan = 0;
        foreach ($dataBulanSebelumnya as $data) {
            foreach ($data['pendataan'] as $item) {
                $totalPenggunaan += $item->total_penggunaan;
            }
        }

        //f Menginisialisasi array untuk data penggunaan air
        $penggunaanPerbulan = [];
        $pendapatanPerbulan = [];

        //g Mendapatkan data penggunaan air dari $dataBulanSebelumnya
        foreach ($dataBulanSebelumnya as $data) {
            $penggunaanPerbulan[] = $data['pendataan']->pluck('total_penggunaan')->sum();
            $pendapatanPerbulan[] = $data['pendataan']->pluck('total_harga')->sum();
        }

        // dd($pendapatanPerbulan);

        return view('dashboard.index', [
            'penggunaanPerbulan' => $penggunaanPerbulan,
            'pendapatanPerbulan' => $pendapatanPerbulan,
            'pelanggan' => $pelanggan,
            'pelangganAktif' => $pelangganAktif,
            'namabulan' => $namabulan,
            'pendapatan' => $pendapatan,
            'jumlahUser' => $jumlahUser,
            'krisar' => $krisar,
            'jumlahPendataan' => $jumlahPendataan,
            'persentasiPendataanBulat' => $persentasiPendataanBulat,
        ]);
    }
}
