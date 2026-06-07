<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMEF Admin - Dashboard</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f4f6f9;
        }
        .sidebar {
            width: 280px;
            min-vh: 100vh;
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            width: calc(100% - 280px);
        }
        .nav-pills .nav-link {
            border-radius: 10px;
            padding: 10px 16px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            margin-bottom: 4px;
            color: #94a3b8 !important;
        }
        .nav-pills .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: #ffffff !important;
            transform: translateX(4px);
        }
        .nav-pills .nav-link.active {
            background: linear-gradient(90deg, #3b82f6 0%, #1d4ed8 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
            font-weight: 600;
        }
        .sidebar-brand {
            font-size: 1.25rem;
            letter-spacing: 0.5px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .menu-category {
            font-size: 0.75rem;
            letter-spacing: 1px;
            color: #64748b !important;
            margin-top: 15px;
            margin-bottom: 5px;
        }
        /* Kustomisasi scrollbar sidebar */
        .sidebar::-webkit-scrollbar {
            width: 5px;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="d-flex">
    <div class="sidebar p-3 d-flex flex-column justify-content-between text-white">
        <div>
            <div class="sidebar-brand text-center pb-3 mb-4 mt-2">
                <h5 class="text-primary mb-0 font-weight-bold d-flex align-items-center justify-content-center gap-2">
                    <i class="fa-solid fa-graduation-cap fs-4"></i>
                    <span class="text-white">SMEF</span><span class="text-info">Admin</span>
                </h5>
            </div>

            <div class="nav flex-column nav-pills">
                
                @if(Auth::user()->role == 'sekjur')
                    <div class="menu-category px-3 text-uppercase font-weight-bold">Menu Master</div>
                    <a href="{{ route('event.index') }}" class="nav-link {{ request()->routeIs('event.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-calendar-days me-2"></i> Master Event
                    </a>
                    <a href="{{ route('prodi.index') }}" class="nav-link {{ request()->routeIs('prodi.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-landmark me-2"></i> Master Prodi
                    </a>
                    <a href="{{ route('ruangan.index') }}" class="nav-link {{ request()->routeIs('ruangan.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-door-open me-2"></i> Master Ruangan
                    </a>
                    
                    <div class="menu-category px-3 text-uppercase font-weight-bold">Administrasi</div>
                    <a href="{{ route('sekjur.endorsement') }}" class="nav-link {{ request()->routeIs('sekjur.endorsement') ? 'active' : '' }}">
                        <i class="fa-solid fa-file-signature me-2"></i> Endorsement Administratif
                    </a>
                    <a href="{{ route('reports.rekap') }}" class="nav-link {{ request()->routeIs('reports.rekap') ? 'active' : '' }}">
                        <i class="fa-solid fa-chart-line me-2"></i> Laporan Rekapitulasi
                    </a>
                @endif

                @if(Auth::user()->role == 'hima')
                    <div class="menu-category px-3 text-uppercase font-weight-bold">Manajemen Event</div>
                    <a href="{{ route('hima.pengajuan.create') }}" class="nav-link {{ request()->routeIs('hima.pengajuan.create') ? 'active' : '' }}">
                        <i class="fa-solid fa-paper-plane me-2"></i> Pengajuan Event Digital
                    </a>
                    <a href="{{ route('tracking.status') }}" class="nav-link {{ request()->routeIs('tracking.status') ? 'active' : '' }}">
                        <i class="fa-solid fa-magnifying-glass-location me-2"></i> Real-time Tracking
                    </a>
                @endif

                @if(Auth::user()->role == 'kaprodi')
                    <div class="menu-category px-3 text-uppercase font-weight-bold">Persetujuan</div>
                    <a href="{{ route('kaprodi.review') }}" class="nav-link {{ request()->routeIs('kaprodi.review') ? 'active' : '' }}">
                        <i class="fa-solid fa-user-check me-2"></i> Rekomendasi Akademik
                    </a>
                @endif

                @if(Auth::user()->role == 'dekan')
                    <div class="menu-category px-3 text-uppercase font-weight-bold">Persetujuan</div>
                    <a href="{{ route('dekan.approval') }}" class="nav-link {{ request()->routeIs('dekan.approval') ? 'active' : '' }}">
                        <i class="fa-solid fa-file-shield me-2"></i> Final Approval Dekanat
                    </a>
                @endif

                @if(Auth::user()->role == 'mahasiswa')
                    <div class="menu-category px-3 text-uppercase font-weight-bold">Aktivitas Mahasiswa</div>
                    <a href="{{ route('mahasiswa.event.explore') }}" class="nav-link {{ request()->routeIs('mahasiswa.event.explore') ? 'active' : '' }}">
                        <i class="fa-solid fa-compass me-2"></i> Registrasi Event
                    </a>
                    <a href="{{ route('presensi.index') }}" class="nav-link {{ request()->routeIs('presensi.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-clipboard-user me-2"></i> Presensi Kehadiran
                    </a>
                @endif

                <div class="menu-category px-3 text-uppercase font-weight-bold">Pengaturan Akun</div>
                <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-gear me-2"></i> Profil & Keamanan
                </a>

            </div>
        </div>

        <div class="pt-3 border-top border-secondary mt-4">
            <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 text-start border-0 d-flex align-items-center gap-2 py-2 px-3" style="border-radius: 10px;">
                    <i class="fa-solid fa-right-from-bracket"></i> 
                    <span>Keluar / Logout</span>
                </button>
            </form>
        </div>
    </div>

    <div class="main-content p-4">
        <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-white rounded shadow-sm">
            <div class="text-secondary small fw-medium">
                <i class="fa-regular fa-clock me-1"></i> Mode Peninjauan: <strong class="text-dark">{{ strtoupper(Auth::user()->role) }}</strong>
            </div>
            <div class="fw-bold text-dark small">
                <i class="fa-regular fa-user me-1 text-primary"></i> {{ Auth::user()->name }}
            </div>
        </div>

        <div class="animate-fade-in">
            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>