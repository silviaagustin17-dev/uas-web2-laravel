@extends('layout.menu')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-primary text-white p-3">
        <h4 class="mb-0"><i class="fa-solid fa-file-arrow-up me-2"></i> Pengajuan Proposal Event Baru</h4>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('hima.pengajuan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label font-weight-bold">Nama Event / Kegiatan</label>
                <input type="text" name="nama_event" class="form-control" placeholder="Contoh: SPARK (Seminar & Pameran Karya)" required>
            </div>
            <div class="mb-3">
                <label class="form-label font-weight-bold">Upload Draft Proposal (PDF/Doc max 2MB)</label>
                <input type="file" name="draft_proposal" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary px-4">Kirimi Pengajuan</button>
        </form>
    </div>
</div>
@endsection