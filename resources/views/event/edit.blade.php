<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow col-md-6 mx-auto">
            <div class="card-header bg-warning">
                <h4 class="mb-0">Edit Data Event</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('event.update', $event->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label>Nama Event</label>
                        <input type="text" name="nama_event" class="form-control" value="{{ $event->nama_event }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ $event->tanggal }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" value="{{ $event->lokasi }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3" required>{{ $event->deskripsi }}</textarea>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update Data</button>
                        <a href="{{ route('event.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>