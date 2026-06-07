@extends('layout.menu')

@section('content')
<div class="card shadow border-0 mb-4">
    <div class="card-header bg-dark text-white p-3">
        <h4 class="mb-0"><i class="fa-solid fa-user-shield me-2"></i> Meja Kerja Sekjur: Validasi Berkas Administrasi</h4>
    </div>
    <div class="card-body p-4">
        @if(!$event_masuk)
            <div class="alert alert-info">Tidak ada berkas permohonan baru yang perlu divalidasi saat ini.</div>
        @else
            <h5>Permohonan Masuk:</h5>
            <div class="p-3 bg-light rounded border mb-4">
                <p><strong>Nama Event:</strong> {{ $event_masuk->nama_event }}</p>
                <p><strong>File Proposal:</strong> <a href="{{ asset('uploads/'.$event_masuk->draft_proposal) }}" target="_blank">Download Draft</a></p>
            </div>
            <div class="d-flex gap-2">
                <form action="{{ route('sekjur.endorsement.process', $event_masuk->id) }}" method="POST">
                    @csrf <input type="hidden" name="status" value="ditolak">
                    <button class="btn btn-danger">Tolak Berkas</button>
                </form>
                <form action="{{ route('sekjur.endorsement.process', $event_masuk->id) }}" method="POST">
                    @csrf <input type="hidden" name="status" value="disetujui">
                    <button class="btn btn-success">Validasi & Teruskan</button>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection