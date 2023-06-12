<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        //get posts
        $pengaduan = User::join('pengaduans', 'users.id', '=', 'pengaduans.id_pelanggan')
            ->latest('pengaduans.created_at')
            ->paginate(10);

        $pengaduans = User::join('pengaduans', 'users.id', '=', 'pengaduans.id_pelanggan')
            ->orderBy('status_pengaduan', 'ASC')
            ->latest('pengaduans.created_at')
            ->where([
                ['nama', '!=', Null],
                [function ($query) use ($request) {
                    if (($s = $request->s)) {
                        $query->orWhere('users.nama', 'LIKE', '%' . $s . '%')
                            ->orWhere('users.role', 'LIKE', '%' . $s . '%')
                            ->orWhere('users.id', 'LIKE', '%' . $s . '%')
                            ->get();
                    }
                }]
            ])
            ->get();

        //render view with posts
        return view('dashboard.pengaduan.index', compact('pengaduans'));
        // return view('dashboard.harga.edit', ['harga' => $harga]);
    }

    public function show(string $id): View
    {
        $pengaduan = User::join('pengaduans', 'users.id', '=', 'pengaduans.id_pelanggan')->where('pengaduans.id', $id)->first();

        if ($pengaduan->status_pengaduan == 'Belum Dilihat') {
            $pngn = Pengaduan::where('id', $id)->first();
            $pngn->status_pengaduan = 'Dilihat';
            $pngn->save();
        }

        return view('dashboard.pengaduan.pengaduandetail', [
            'pengaduan' => $pengaduan,
        ]);
    }
}
