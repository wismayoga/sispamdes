<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Harga;
use Illuminate\Http\Request;

class HargaController extends Controller
{
    public function index()
    {
        //get posts
        $harga = Harga::all();
        //render view with posts
        return view('dashboard.harga.index', compact('harga'));
        // return view('dashboard.harga.edit', ['harga' => $harga]);
        
    }

    public function edit(Harga $harga)
    {
        //
        // return view('dashboard.harga.edit', compact('harga'));
        return view('dashboard.harga.edit', ['harga' => $harga]);
    }

    public function update(Request $request, Harga $harga)
    {
        //validate form
        $this->validate($request, [
            'level1'     => 'required',
            'level2'     => 'required',
            'level3'   => 'required'
        ]);
        
        //update harga
        $harga->update([
            'level1'     => $request->level1,
            'level2'   => $request->level2,
            'level3'   => $request->level3,
        ]);

        //kembali
        return redirect()->route('harga.index')->with(['success' => 'Harga Berhasil Diubah!']);
        
    }
}
