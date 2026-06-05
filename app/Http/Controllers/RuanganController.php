<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index() {
        $ruangans = Ruangan::all();
        return view('ruangan.index', compact('ruangans'));
    }

    public function store(Request $request) {
        Ruangan::create($request->all());
        return redirect()->route('ruangan.index');
    }

    // Ambil data ruangan yang mau diedit, lalu lempar ke halaman edit
    public function edit($id) {
        $ruangan = Ruangan::findOrFail($id);
        return view('ruangan.edit', compact('ruangan'));
    }

    // Proses menyimpan perubahan data ruangan dari halaman edit ke database
    public function update(Request $request, $id) {
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->update($request->all());
        return redirect()->route('ruangan.index');
    }

    public function destroy($id) {
        Ruangan::findOrFail($id)->delete();
        return redirect()->route('ruangan.index');
    }
}