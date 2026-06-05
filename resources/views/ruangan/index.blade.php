<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Data Ruangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            @include('layout.menu')

            <div class="col-md-10 p-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="fa-solid fa-door-open text-primary me-2"></i> Kelola Data Master Ruangan</h2>
                    <span class="badge bg-secondary p-2">Sistem Manajemen Event Fakultas</span>
                </div>

                <div class="card shadow border-0 mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="mb-0"><i class="fa-solid fa-plus me-2"></i> Tambah Ruangan Baru</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('ruangan.store') }}" method="POST" class="row g-3">
                            @csrf
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nama Ruangan</label>
                                <input type="text" name="nama_ruangan" class="form-control" placeholder="Contoh: Aula Gedung H / Lab 2" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Kapasitas</label>
                                <input type="number" name="kapasitas" class="form-control" placeholder="Contoh: 100" required>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-success w-100 py-2"><i class="fa-solid fa-save me-2"></i>Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card shadow border-0">
                    <div class="card-body p-4">
                        <table class="table table-bordered table-striped align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Ruangan</th>
                                    <th>Kapasitas</th>
                                    <th width="15%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($ruangans) > 0)
                                    @foreach($ruangans as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td class="fw-bold text-secondary">{{ $item->nama_ruangan }}</td>
                                        <td><span class="badge bg-info text-dark">{{ $item->kapasitas }} Orang</span></td>
                                        <td class="text-center">
                                            <div class="d-flex gap-2 justify-content-center">
                                                <a href="{{ route('ruangan.edit', $item->id) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                                                <form action="{{ route('ruangan.destroy', $item->id) }}" method="POST">
                                                    @csrf 
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus ruangan ini?')">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">Belum ada data master ruangan. Silakan tambah data di atas!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>