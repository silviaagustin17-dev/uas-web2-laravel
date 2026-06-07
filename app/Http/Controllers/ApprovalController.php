<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; // <--- INI YANG WAJIB ADA
use Illuminate\Support\Facades\Storage;

class ApprovalController extends Controller
{
    // ==========================================
    // 1. MEJA KERJA SEKJUR
    // ==========================================
    public function sekjurIndex()
    {
        $event_masuk = DB::table('events')->where('status', 'Pending Sekjur')->latest()->first();
        return view('approval.sekjur', compact('event_masuk'));
    }

    public function sekjurProcess(Request $request, $id)
    {
        $isApproved = $request->input('status') === 'disetujui';
        
        DB::table('events')->where('id', $id)->update([
            'status'  => $isApproved ? 'Pending Kaprodi' : 'Ditolak Sekjur',
            'catatan' => $isApproved 
                         ? 'Berkas valid. Diteruskan ke Kaprodi untuk review kelayakan akademik.' 
                         : 'Draft berkas administrasi tidak lengkap atau salah template.'
        ]);

        return back()->with($isApproved ? 'success' : 'error', $isApproved ? 'Berkas lolos!' : 'Pengajuan ditolak.');
    }

    // ==========================================
    // 2. MEJA KERJA KAPRODI
    // ==========================================
    public function kaprodiIndex()
    {
        $event_masuk = DB::table('events')->where('status', 'Pending Kaprodi')->latest()->first();
        return view('approval.kaprodi', compact('event_masuk'));
    }

    public function kaprodiProcess(Request $request, $id)
    {
        $isApproved = $request->input('status') === 'disetujui';

        DB::table('events')->where('id', $id)->update([
            'status'  => $isApproved ? 'Pending Dekan' : 'Ditolak Kaprodi',
            'catatan' => $isApproved 
                         ? 'Rekomendasi akademik disetujui Kaprodi. Menunggu tanda tangan final Dekan.' 
                         : 'Proposal ditolak Kaprodi karena tidak relevan dengan kompetensi prodi.'
        ]);

        return back()->with($isApproved ? 'success' : 'error', $isApproved ? 'Rekomendasi diberikan!' : 'Pengajuan ditolak.');
    }

    // ==========================================
    // 3. MEJA KERJA DEKAN
    // ==========================================
    public function dekanIndex()
    {
        $event_masuk = DB::table('events')->where('status', 'Pending Dekan')->latest()->first();
        return view('approval.dekan', compact('event_masuk'));
    }

    public function dekanProcess(Request $request, $id)
    {
        $isApproved = $request->input('status') === 'disetujui';

        DB::table('events')->where('id', $id)->update([
            'status'  => $isApproved ? 'Disetujui Dekan' : 'Ditolak Dekan',
            'catatan' => $isApproved 
                         ? 'SK Kegiatan resmi diterbitkan oleh Dekanat.' 
                         : 'Ditolak Dekan. Anggaran biaya terlalu tinggi.'
        ]);

        return back()->with($isApproved ? 'success' : 'error', $isApproved ? 'Event resmi disahkan!' : 'Pengajuan ditolak.');
    }

    public function dekanLhkProcess(Request $request, $id)
    {
        $isAccepted = $request->input('action') === 'terima';
        $catatan    = $request->input('catatan_lhk');

        DB::table('events')->where('id', $id)->update([
            'status_lhk' => $isAccepted ? 'LHK Diterima' : 'LHK Direvisi',
            'catatan'    => ($isAccepted ? 'LHK Selesai! ' : 'LHK Butuh Revisi: ') . $catatan
        ]);

        return back()->with($isAccepted ? 'success' : 'error', $isAccepted ? 'LHK Disahkan!' : 'LHK dikembalikan ke HIMA.');
    }

    // ==========================================
    // 4. DOWNLOAD PROPOSAL (Mencegah 403 Forbidden)
    // ==========================================
   public function downloadProposal($id)
    {
        $event = \DB::table('events')->where('id', $id)->first();

        if (!$event || !$event->draft_proposal) {
            return back()->with('error', 'File tidak ditemukan!');
        }

        // Kita gunakan path absolut manual untuk menghindari error variabel
        $path = storage_path('app/public/' . $event->draft_proposal);

        if (!file_exists($path)) {
            return back()->with('error', 'File fisik tidak ditemukan di: ' . $path);
        }

        return response()->download($path);
    }
}