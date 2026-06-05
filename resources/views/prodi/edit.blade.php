<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Program Studi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            @include('layout.menu')

            <div class="col-md-10 p-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="fa-solid fa-pen-to-square text-warning me-2"></i> Edit Data Master Prodi</h2>
                    <a href="{{ route('prodi.index') }}" class="btn btn-secondary btn-sm"><i class="fa-solid fa-arrow-left me-1"></i> Kembali</a>
                </div>

                <div class="card shadow border-0">
                    <div class="card-header bg-warning text-white py-3">
                        <h5 class="mb-0"><i class="fa-solid fa-edit me-2"></i> Ubah Informasi Program Studi</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('prodi.update', $prodi->id) }}" method="POST" class="row g-3">
                            @csrf
                            @method('PUT')
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Nama Prodi</label>
                                <input type="text" name="nama_prodi" class="form-control" value="{{ $prodi->nama_prodi }}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Kode Prodi</label>
                                <input type="text" name="kode_prodi" class="form-control" value="{{ $prodi->kode_prodi }}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Kepala Prodi (Kaprodi)</label>
                                <input type="text" name="kepala_prodi" class="form-control" value="{{ $prodi->kepala_prodi }}" required>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-warning w-100 py-2 text-white"><i class="fa-solid fa-rotate me-2"></i>Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>