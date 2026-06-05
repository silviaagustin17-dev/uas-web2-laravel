<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Fullstack Survival</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-dark d-flex align-items-center" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <i class="fa-solid fa-shield-halved fa-3x text-primary mb-3"></i>
                            <h4 class="fw-bold">UAS Web - Login</h4>
                            <p class="text-muted small">Silakan masuk untuk mengelola master data</p>
                        </div>

                        @if($errors->has('loginError'))
                            <div class="alert alert-danger py-2 small" role="alert">
                                {{ $errors->first('loginError') }}
                            </div>
                        @endif

                        <form action="{{ route('login.process') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="silvia@admin.com" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label small fw-bold">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-bold shadow"><i class="fa-solid fa-sign-in me-2"></i>Masuk Aplikasi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>