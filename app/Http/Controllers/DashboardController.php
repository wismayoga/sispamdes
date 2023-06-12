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
        //DATA UNTUK CARD
        $jumlahUser = DB::table('users')->count();
        $jumlahPendataan = DB::table('pendataans')->whereMonth('created_at', '=', Carbon::now()->month)->count();
        $persentasiPendataan = $jumlahPendataan / $jumlahUser * 100;
        $persentasiPendataanBulat = number_format((float)$persentasiPendataan, 2, '.', '');
        $pendapatan = DB::table('pendataans')
            ->whereMonth('created_at', '=', Carbon::now()->month)
            ->where('status_pembayaran', 'Lunas')
            ->sum('total_harga');
        $pelangganAktif = DB::table('users')->where('status', 'Aktif')->count();
        $pelanggan = DB::table('users')->count();
        $krisar = DB::table('pengaduans')->where('status_pengaduan', 'Belum Dilihat')->count();
        $namabulan = Carbon::now()->translatedFormat('F Y');

        // DATA UNTUK TABEL
        $pendataanterbaru = DB::table('pendataans')->whereDate('created_at', Carbon::today())->count();
        $pendataanTable = DB::table('pendataans')
            ->whereDate('pendataans.created_at', Carbon::today())
            ->leftJoin('users as tabel_pelanggan', 'pendataans.id_pelanggan', '=', 'tabel_pelanggan.id')
            ->leftJoin('users as tabel_petugas', 'pendataans.id_petugas', '=', 'tabel_petugas.id')
            ->select("pendataans.*", 'tabel_petugas.nama as nama_petugas', 'tabel_pelanggan.nama as nama_pelanggan',)
            ->orderBy('created_at', 'DESC')
            ->get();
        // dd($pendataanTable);

        // -- DATA UNTUK CHART --
        $now = Carbon::now();
        $dataBulanSebelumnya = [];

        for ($i = 1; $i <= $now->month; $i++) {
            $bulan = $i;
            $tahun = $now->year;

            // Mengambil data dari tabel "pendataan" berdasarkan bulan dan tahun
            $pendataan = DB::table('pendataans')
                ->whereMonth('created_at', $bulan)
                ->whereYear('created_at', $tahun)
                ->get();

            // Lakukan apa pun yang perlu Anda lakukan dengan bulan dan tahun ini, misalnya, mengambil data dari database
            // dan menambahkannya ke $dataBulanSebelumnya array.
            // Contoh:
            $dataBulanSebelumnya[] = [
                'bulan' => $bulan,
                'tahun' => $tahun,
                'pendataan' => $pendataan,
            ];
            // Setel tanggal kembali ke bulan saat ini untuk iterasi berikutnya.
        }

        //totalpenggunaan
        $totalPenggunaan = 0;
        foreach ($dataBulanSebelumnya as $data) {
            foreach ($data['pendataan'] as $item) {
                $totalPenggunaan += $item->total_penggunaan;
            }
        }

        // Menginisialisasi array untuk data penggunaan air
        $penggunaanPerbulan = [];
        $pendapatanPerbulan = [];
        // Mendapatkan data penggunaan air dari $dataBulanSebelumnya
        foreach ($dataBulanSebelumnya as $data) {
            $penggunaanPerbulan[] = $data['pendataan']->pluck('total_penggunaan')->sum();
            $pendapatanPerbulan[] = $data['pendataan']->pluck('total_harga')->sum();
        }



        // -- DATA UNTUK CHART --

        return view('dashboard.index', [
            'pendataanTable' => $pendataanTable,
            'pendataanterbaru' => $pendataanterbaru,
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
