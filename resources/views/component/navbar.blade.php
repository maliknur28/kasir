<nav class="navbar navbar-expand-sm navbar-dark bg-dark" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="#"><b>KASIR</b></a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId"
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                @if (Auth::user()->role == 'Admin')
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}"
                            href="{{ route('home') }}" aria-current="page">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'register' ? 'active' : '' }}"
                            href="{{ route('register') }}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'product' ? 'active' : '' }}"
                            href="{{ route('product') }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'discount' ? 'active' : '' }}"
                            href="{{ route('discount') }}">Diskon</a>
                    </li>
                @endif
                @if (Auth::user()->role == 'Petugas')
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'transaction' ? 'active' : '' }}"
                            href="{{ route('transaction') }}">Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'member' ? 'active' : '' }}"
                            href="{{ route('member') }}">Anggota</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Route::currentRouteName() == 'report.transaction' || Route::currentRouteName() == 'report.stock' ? 'active' : '' }}"
                            href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">Laporan</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="dropdown-item {{ Route::currentRouteName() == 'report.transaction' ? 'active' : '' }}"
                                href="{{ route('report.transaction') }}"><i class="bi bi-cash"></i>
                                Transaksi</a>
                            <a class="dropdown-item {{ Route::currentRouteName() == 'report.stock' ? 'active' : '' }}"
                                href="{{ route('report.stock') }}"><i class="bi bi-box-seam"></i> Stok</a>
                        </div>
                    </li>
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}"
                        href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">{{ Auth::user()->role }}</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}"
                            href="{{ route('profile') }}"><i class="bi bi-person-gear"></i> Profil</a>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="dropdown-item" data-confirm-delete="true"
                                onclick="return confirm('Apakah Anda Yakin?')"><i class="bi bi-box-arrow-right"></i>
                                Logout</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
