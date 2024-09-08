<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom" id="navpertama">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <a class="navbar-brand" href="/">
                        <img src="{{ asset('img/logo-kemensos.png') }}" alt="Kemensos Logo" class="img-fluid" style="max-width: 50px;">
                    </a>
                </div>
                <div class="col-6 text-center">
                    <ul class="navbar-nav ">
                        <li class="nav-item ">
                            <a class="nav-link fw-bolder {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">Kementrian Sosial Republik Indonesia</a>
                        </li>
                    </ul>
                </div>
                <div class="col-2 text-end">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-danger" type="submit">Logout</button>
                    </form>
                </div>
                {{-- <div class="col-12 text-center mt-2">
                    <p class="mb-0">Logged in as: <strong>{{ Auth::user()->name }}</strong></p>
                </div> --}}
            </div>
        </div>
    </div>
</nav>


<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom" id="navkedua">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link fw-bolder {{ Request::is('Pengumuman') ? 'active' : '' }}" href="/Pengumuman">Pengumuman Informasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bolder {{ Request::is('Pendataan') ? 'active' : '' }}" href="/Pendataan">Pendataan Mandiri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bolder {{ Request::is('Penerima') ? 'active' : '' }}" href="/Penerima">Penerima Bansos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bolder {{ Request::is('Monitoring') ? 'active' : '' }}" href="/Monitoring">Monitoring</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bolder {{ Request::is('Laporan') ? 'active' : '' }}" href="/Laporan">Laporan</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom" id="navketiga">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto  mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active fw-bolder" href="#">
                        @if(request()->is('dashboard'))
                            Dashboard
                        @elseif(request()->is('Pengumuman'))
                            Pengumuman Informasi
                        @elseif(request()->is('Pendataan'))
                            Pendataan Mandiri
                        @elseif(request()->is('Penerima'))
                            Penerima Bansos
                        @elseif(request()->is('Monitoring'))
                            Monitoring
                        @elseif(request()->is('Laporan'))
                            Laporan
                        @else
                            Dashboard
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
