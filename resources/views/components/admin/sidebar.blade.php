<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/polos.png') }}" alt="Kemensos Logo" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
        </div>
        <div class="sidebar-brand-text mx-3">Kemensos RI</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <!-- ... other sidebar items ... -->
    <hr class="sidebar-divider">
    @php
        $userRole = Auth::user()->role ?? '';
    @endphp
    @if(in_array($userRole, ['Unit-Kerja', 'Warga']))
        <li class="nav-item {{ Request::is('Pengumuman') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/Pengumuman') }}">
                <i class="fas fa-fw fa-bullhorn"></i>
                <span>Pengumuman</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('Penerima') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/Penerima') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Penerima</span>
            </a>
        </li>
    @endif
    @if($userRole === 'Warga')
        <li class="nav-item {{ Request::is('Pendataan') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/Pendataan') }}">
                <i class="fas fa-fw fa-clipboard-list"></i>
                <span>Pendataan</span>
            </a>
        </li>
    @endif
    @if($userRole === 'Unit-Kerja')
        <li class="nav-item {{ Request::is('Monitoring') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/Monitoring') }}">
                <i class="fas fa-fw fa-chart-line"></i>
                <span>Monitoring</span>
            </a>
        </li>
    @endif
    @if(in_array($userRole, ['Unit-Kerja', 'Mentri-Sosial']))
        <li class="nav-item {{ Request::is('Laporan') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/Laporan') }}">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Laporan</span>
            </a>
        </li>
    @endif
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
