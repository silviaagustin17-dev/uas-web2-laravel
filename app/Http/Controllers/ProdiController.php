<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        // TARIK SEMUA DATA DARI DATABASE
        $prodis = Prodi::all(); 
        
        // KIRIM KE VIEW
        return view('prodi.index', compact('prodis'));
    }

    public function store(Request $request) {
        Prodi::create($request->all());
        return redirect()->route('prodi.index');
    }

    // Ambil data prodi yang mau diedit, lalu lempar ke halaman edit
    public function edit($id) {
        $prodi = Prodi::findOrFail($id);
        return view('prodi.edit', compact('prodi'));
    }

    // Proses menyimpan perubahan data prodi dari halaman edit ke database
    public function update(Request $request, $id) {
        $prodi = Prodi::findOrFail($id);
        $prodi->update($request->all());
        return redirect()->route('prodi.index');
    }

    public function destroy($id) {
        Prodi::findOrFail($id)->delete();
        return redirect()->route('prodi.index');
    }
}