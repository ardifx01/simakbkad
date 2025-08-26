<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pembendaharaan.dashboard') }}">
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
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('pembendaharaan.disposisi.index') }}">Disposisi Surat
                            Masuk</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('bendahara.suratmasuk.selesai') }}">Arsip
                            Surat</a></li>
                </ul>
            </div>
        </li>
        <!-- Menu Logout -->
        <li class="nav-item">
            <a class="nav-link" href="#" onclick="event.preventDefault(); showLogoutLoading();">
                <i class="ti-power-off menu-icon"></i>
                <span class="menu-title">Keluar</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>
