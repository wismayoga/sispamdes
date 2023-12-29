<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {   
        $users = DB::table('users')->where('role', '=', 'Pelanggan')->where('status', '=', 'Aktif')->count();
        $tahunBerdiri = date('Y') - 2013;

        return view('index', [
            'users' => $users,
            'tahunBerdiri' => $tahunBerdiri
        ]);
    }
}
