<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('kepala.dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#suratmasuk" aria-expanded="false"
                aria-controls="suratmasuk">
                <i class="ti-agenda menu-icon"></i>
                <span class="menu-title">Surat Masuk</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="suratmasuk">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('kepala.dataSuratMasuk') }}">Surat Masuk</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('kepala.suratmasuk.selesai') }}">Arsip Surat</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#" aria-expanded="false" aria-controls="charts"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="ti-power-off menu-icon"></i>
                <span class="menu-title">Keluar</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>
