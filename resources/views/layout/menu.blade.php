<div class="col-md-2 bg-dark text-white p-3 min-vh-screen">
    <h5 class="text-center text-primary mb-4"><i class="fa-solid fa-graduation-cap"></i> SMEF Admin</h5>
    <div class="nav flex-column nav-pills">
        <a href="{{ route('event.index') }}" class="nav-link text-white {{ request()->routeIs('event.*') ? 'active' : '' }}">Master Event</a>
        <a href="{{ route('prodi.index') }}" class="nav-link text-white {{ request()->routeIs('prodi.*') ? 'active' : '' }}">Master Prodi</a>
        <a href="{{ route('ruangan.index') }}" class="nav-link text-white {{ request()->routeIs('ruangan.*') ? 'active' : '' }}">Master Ruangan</a>
    </div>
</div>


