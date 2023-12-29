<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pendataan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{
    public function index(Request $request)
    {
        //get posts
        // $users = User::paginate(10);
        $users = User::where([
            ['nama', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->s)) {
                    $query->orWhere('nama', 'LIKE', '%' . $s . '%')
                        ->orWhere('role', 'LIKE', '%' . $s . '%')
                        ->orWhere('id', 'LIKE', '%' . $s . '%')
                        ->get();
                }
            }]
        ])
            ->orderByRaw("FIELD(role , 'Admin', 'Petugas', 'Pelanggan') ASC")
            ->orderBy('status', 'ASC')
            ->orderBy('nama', 'ASC')
            ->get();



        //render view with posts
        // return view('dashboard.user.index', compact('users'));
        return view('dashboard.user.index', [
            'users' => $users,
        ]);

    }

    public function show(string $id): View
    {
        $user = DB::table('users')->where('id', $id)->first();
        $pendataan = DB::table('pendataans')
            ->leftJoin('users as tabel_pelanggan', 'pendataans.id_pelanggan', '=', 'tabel_pelanggan.id')
            ->leftJoin('users as tabel_petugas', 'pendataans.id_petugas', '=', 'tabel_petugas.id')
            ->select("pendataans.*", 'tabel_petugas.nama as nama_petugas', 'tabel_pelanggan.nama as nama_pelanggan',)
            ->orderBy('status_pembayaran', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->where('pendataans.id_pelanggan', $id)
            ->paginate(3);

        $statuspendataan = Pendataan::whereMonth('created_at', '=', Carbon::now()->month)
        ->where('id_pelanggan', $id)->count();

        if($statuspendataan > 0){
            $status = "Sudah";
        }else{
            $status = "Belum";
        }

        return view('dashboard.user.userdetail', [
            'user' => $user,
            'pendataan' => $pendataan,
            'status' => $status,
        ]);
    }

    public function create()
    {
        return view('dashboard.user.create');
    }

    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'konsentrasi' => 'required|unique:alternatifs|max:255',
        //     'ket' => 'max:255',
        //     'photo' => 'image|mimes:jpeg,png,jpg,gif,svg',
        // ], [
        //     'konsentrasi.unique' => 'Konsentrasi sudah ada.',
        // ]);
        // dd($request);
        User::create([
            'role'   => $request->role,
            'email'           => $request->email,
            'password'          => Hash::make($request->password),
            'nama'          => $request->nama,
            'status'          => 'Aktif',
            'nomor_hp'          => $request->nomor_hp,
            'alamat'          => $request->alamat,
            'foto_profil'          => '',
        ]);
        return redirect()->route('users.index')->with('success', 'Data berhasil ditambahkan !');
    }

    public function edit(User $user)
    {
        //
        // return view('dashboard.harga.edit', compact('harga'));
        return view('dashboard.user.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        //validate form
        $this->validate($request, [
            'role'     => 'required',
            'nama'     => 'required',
            'email'   => 'required',
            'nomor_hp'   => 'required',
            'status'   => 'required',
        ]);

        // dd($request);

        //update harga
        if($request->password == ''){
            $user->update([
                'nama'     => $request->nama,
                'role'   => $request->role,
                'email'   => $request->email,
                'nomor_hp'     => $request->nomor_hp,
                'alamat'   => $request->alamat,
                'status'   => $request->status,
            ]);
        }else{
            $user->update([
                'nama'     => $request->nama,
                'role'   => $request->role,
                'email'   => $request->email,
                'nomor_hp'     => $request->nomor_hp,
                'alamat'   => $request->alamat,
                'status'   => $request->status,
                'password'   => Hash::make($request->password),
            ]);
        }
        

        //kembali
        return redirect()->route('users.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(User $user)
    {
        User::destroy($user->id);

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus !');
    }

    //pendataan
    public function pendataan()
    {
        
        return redirect('pendataans')->with('success', 'Pendataan Berhasil Ditambah !');
    }
}
