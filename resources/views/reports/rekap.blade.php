@extends('layout.menu')

@section('content')
<div class="container p-4">
    <div class="card shadow border-0">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Rekapitulasi Event</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Event</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Pastikan di ReportController kamu mengirim data $events --}}
                    @foreach($events as $key => $event)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $event->nama_event }}</td>
                        <td>{{ $event->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection