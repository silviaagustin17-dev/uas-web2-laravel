<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Data Program Studi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            @include('layout.menu')

            <div class="col-md-10 p-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="fa-solid fa-university text-primary me-2"></i> Kelola Data Master Prodi</h2>
                    <span class="badge bg-secondary p-2">Sistem Manajemen Event Fakultas</span>
                </div>

                <div class="card shadow border-0 mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="mb-0"><i class="fa-solid fa-plus me-2"></i> Tambah Program Studi Baru</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('prodi.store') }}" method="POST" class="row g-3">
                            @csrf
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Nama Prodi</label>
                                <input type="text" name="nama_prodi" class="form-control" placeholder="Contoh: Informatika" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Kode Prodi</label>
                                <input type="text" name="kode_prodi" class="form-control" placeholder="Contoh: IF-01" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Kepala Prodi (Kaprodi)</label>
                                <input type="text" name="kepala_prodi" class="form-control" placeholder="Nama Dosen Kaprodi" required>
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
                                    <th>Nama Prodi</th>
                                    <th>Kode Prodi</th>
                                    <th>Kepala Prodi (Aktor)</th>
                                    <th width="15%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($prodis) > 0)
                                    @foreach($prodis as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td class="fw-bold text-secondary">{{ $item->nama_prodi }}</td>
                                        <td><span class="badge bg-info text-dark">{{ $item->kode_prodi }}</span></td>
                                        <td class="text-primary fw-bold">{{ $item->kepala_prodi }}</td>
                                        <td class="text-center">
                                            <div class="d-flex gap-2 justify-content-center">
                                                <a href="{{ route('prodi.edit', $item->id) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                                                <form action="{{ route('prodi.destroy', $item->id) }}" method="POST">
                                                    @csrf 
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus prodi ini?')">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">Belum ada data master prodi. Silakan tambah data di atas!</td>
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