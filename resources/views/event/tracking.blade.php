@extends('layout.menu')

@section('content')
<div class="card shadow border-0 mb-4">
    <div class="card-header bg-primary text-white p-3">
        <h4 class="mb-0"><i class="fa-solid fa-magnifying-glass-location me-2"></i> Tracking Status & LHK</h4>
    </div>
    <div class="card-body p-4">
        @if(!$event)
            <div class="alert alert-warning">Belum ada pengajuan proposal kegiatan.</div>
        @else
            <!-- Tabel Tracking Utama (Sama seperti sebelumnya) -->
            <table class="table table-hover border align-middle mb-4">
                <thead class="table-light">
                    <tr>
                        <th>Nama Event</th>
                        <th>Status Proposal</th>
                        <th>Status LHK</th>
                        <th>Catatan Terkini</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>{{ $event->nama_event }}</strong></td>
                        <td><span class="badge bg-success">{{ $event->status }}</span></td>
                        <td>
                            @if(!$event->status_lhk)
                                <span class="badge bg-secondary">Belum Upload LHK</span>
                            @elseif($event->status_lhk == 'LHK Direvisi')
                                <span class="badge bg-danger">{{ $event->status_lhk }}</span>
                            @elseif($event->status_lhk == 'LHK Diterima')
                                <span class="badge bg-success">{{ $event->status_lhk }}</span>
                            @else
                                <span class="badge bg-warning text-dark">{{ $event->status_lhk }}</span>
                            @endif
                        </td>
                        <td><i class="text-muted">{{ $event->catatan }}</i></td>
                    </tr>
                </tbody>
            </table>

            <!-- FORM UPLOAD LHK: Hanya muncul jika Proposal sudah Disetujui Dekan -->
            @if($event->status == 'Disetujui Dekan' && ($event->status_lhk == null || $event->status_lhk == 'LHK Direvisi'))
                <div class="p-3 bg-light rounded border">
                    <h5 class="text-primary"><i class="fa-solid fa-cloud-arrow-up me-2"></i> Upload Laporan Hasil Kegiatan (LHK)</h5>
                    <p class="text-muted small">Proposal Anda telah disetujui. Silakan unggah draf laporan akhir kegiatan di bawah ini untuk diperiksa Dekan.</p>
                    
                    <form action="{{ route('hima.upload_lhk', $event->id) }}" method="POST" enctype="multipart/form-data" class="row g-2">
                        @csrf
                        <div class="col-md-8">
                            <input type="file" name="file_lhk" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary w-100">Kirim LHK ke Dekan</button>
                        </div>
                    </form>
                </div>
            @endif
        @endif
    </div>
</div>
@endsection