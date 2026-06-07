<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{

// Di dalam app/Http/Controllers/EventController.php
public function index() {
    $events = \App\Models\Event::all(); // Menggunakan Model untuk mengambil data
    return view('event.index', compact('events'));
}

    // Halaman Form Pengajuan HIMA
    public function himaCreate()
    {
        return view('event.create_hima');
    }

    // Proses Simpan Form & Upload File Draft
    public function himaStore(Request $request)
    {
        $request->validate([
            'nama_event' => 'required',
            'draft_proposal' => 'required|mimes:pdf,doc,docx|max:2048'
        ]);

        // Proses upload file draft proposal ke folder public/uploads
        $fileName = time().'_'.$request->file('draft_proposal')->getClientOriginalName();
        $request->file('draft_proposal')->move(public_path('uploads'), $fileName);

        // Simpan ke database menggunakan Query Builder simple
        DB::table('events')->insert([
            'nama_event' => $request->nama_event,
            'draft_proposal' => $fileName,
            'status' => 'Pending Sekjur',
            'catatan' => 'Menunggu pengecekan berkas oleh Sekjur.',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('tracking.status')->with('success', 'Proposal berhasil diajukan!');
    }

    // Melihat Tracking Status Berdasarkan Data Database
    public function trackingStatus()
    {
        // Ambil data event paling terbaru yang diajukan
        $event = DB::table('events')->latest()->first();
        return view('event.tracking', compact('event'));
    }

    public function uploadLhk(Request $request, $id)
{
    $request->validate([
        'file_lhk' => 'required|mimes:pdf,doc,docx|max:2048'
    ]);

    // Upload file LHK ke folder public/uploads
    $fileName = 'LHK_'.time().'_'.$request->file('file_lhk')->getClientOriginalName();
    $request->file('file_lhk')->move(public_path('uploads'), $fileName);

    // Update status langsung tembus ke Dekan
    DB::table('events')->where('id', $id)->update([
        'file_lhk' => $fileName,
        'status_lhk' => 'Pending Review Dekan',
        'catatan' => 'LHK telah dikirim oleh HIMA. Menunggu pemeriksaan Dekan.'
    ]);

    return back()->with('success', 'File LHK berhasil dikirim langsung ke Dekan!');
}
}