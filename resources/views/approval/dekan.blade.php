@extends('layout.menu')

@section('content')
<!-- Notifikasi Feedback Sukses / Gagal -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>🎉 Keputusan Disimpan:</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>⚠️ Keputusan Disimpan:</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- ========================================================================= -->
<!-- 1. BAGIAN APPROVAL PROPOSAL EVENT -->
<!-- ========================================================================= -->
<div class="card shadow border-0 mb-4">
    <div class="card-header bg-danger text-white p-3">
        <h4 class="mb-0"><i class="fa-solid fa-file-signature me-2"></i> Meja Kerja Dekan: Final Approval Event</h4>
    </div>
    <div class="card-body p-4">
        @if(!$event_masuk)
            <div class="alert alert-info mb-0">Tidak ada pengajuan proposal event baru yang memerlukan persetujuan saat ini.</div>
        @else
            <h5 class="text-muted mb-4">Permohonan Persetujuan Akhir Kegiatan:</h5>
            
            <div class="p-3 bg-light rounded border mb-4">
                <div class="row"><div class="col-md-3"><strong>Nama Event:</strong></div><div class="col-md-9 text-primary"><h5>{{ $event_masuk->nama_event }}</h5></div></div><hr>
                <div class="row"><div class="col-md-3"><strong>File Proposal:</strong></div><div class="col-md-9"><a href="{{ asset('uploads/'.$event_masuk->draft_proposal) }}" target="_blank" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-file-pdf"></i> Lihat Dokumen Draft</a></div></div><hr>
                <div class="row"><div class="col-md-3"><strong>Rekomendasi:</strong></div><div class="col-md-9"><span class="badge bg-success">✓ Endorsed Sekjur</span> <span class="badge bg-success">✓ Recommended Kaprodi</span></div></div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <form action="{{ route('dekan.approval.process', $event_masuk->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="ditolak">
                    <button type="submit" class="btn btn-danger px-4 font-weight-bold">
                        <i class="fa-solid fa-xmark me-1"></i> TOLAK PROPOSAL
                    </button>
                </form>
                
                <form action="{{ route('dekan.approval.process', $event_masuk->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="disetujui">
                    <button type="submit" class="btn btn-success px-5 font-weight-bold">
                        <i class="fa-solid fa-check-double me-1"></i> SETUJUI / APPROVE
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>

<!-- ========================================================================= -->
<!-- 2. BAGIAN MEJA KERJA REVIEW LHK (LANGSUNG TEMBUS DARI HIMA) -->
<!-- ========================================================================= -->
@php
    $lhk_masuk = DB::table('events')->where('status_lhk', 'Pending Review Dekan')->first();
@endphp

@if($lhk_masuk)
<div class="card shadow border-0 mt-4">
    <div class="card-header bg-info text-dark p-3">
        <h4 class="mb-0"><i class="fa-solid fa-file-shield me-2"></i> Pemeriksaan LHK Masuk dari HIMA</h4>
    </div>
    <div class="card-body p-4">
        <h5 class="text-muted mb-4">Validasi Laporan Pertanggungjawaban Akhir Kegiatan:</h5>
        
        <div class="p-3 bg-light rounded border mb-3">
            <p class="mb-2"><strong>Nama Event:</strong> {{ $lhk_masuk->nama_event }}</p>
            <p class="mb-0"><strong>Berkas LHK:</strong> <a href="{{ asset('uploads/'.$lhk_masuk->file_lhk) }}" target="_blank" class="btn btn-sm btn-danger"><i class="fa-solid fa-file-invoice"></i> Buka File LHK</a></p>
        </div>
        
        <form action="{{ route('dekan.lhk.process', $lhk_masuk->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label font-weight-bold text-secondary">Catatan / Arahan Revisi Dekan</label>
                <textarea name="catatan_lhk" class="form-control" rows="2" placeholder="Ketik catatan revisi (jika ditolak) atau pesan apresiasi (jika diterima) di sini..." required></textarea>
            </div>
            <div class="d-flex gap-2 justify-content-end">
                <button type="submit" name="action" value="revisi" class="btn btn-warning font-weight-bold">
                    <i class="fa-solid fa-rotate-left me-1"></i> ↩ Kembalikan / Minta Revisi
                </button>
                <button type="submit" name="action" value="terima" class="btn btn-success font-weight-bold px-4">
                    <i class="fa-solid fa-square-check me-1"></i> ✓ Terima & Sahkan LHK
                </button>
            </div>
        </form>
    </div>
</div>
@endif
@endsection