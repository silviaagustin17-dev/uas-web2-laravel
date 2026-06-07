@extends('layout.menu') 

@section('content')
<div class="container">
    @if($event_masuk)
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">File Proposal:</div>
                    <div class="col-md-9">{{ $event_masuk->draft_proposal }}</div>
                </div>

                <form action="{{ route('kaprodi.review.process', $event_masuk->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Proses</button>
                </form>
            </div>
        </div>
    @else
        <div class="alert alert-info text-center">
            <h4>Tidak ada pengajuan</h4>
            <p>Belum ada proposal yang masuk ke meja Kaprodi saat ini.</p>
        </div>
    @endif
</div>
@endsection