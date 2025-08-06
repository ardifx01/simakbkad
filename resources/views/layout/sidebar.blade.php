  <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="ti-agenda menu-icon"></i>
              <span class="menu-title">Manajemen Surat Masuk</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.input_surat') }}">Input Surat Masuk</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ asset('assets/pages/ui-features/dropdowns.html') }}">Data Surat Masuk</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="ti-stats-up menu-icon"></i>
              <span class="menu-title">Pemantauan Surat</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ asset('assets/pages/forms/basic_elements.html') }}">Pelacakan Surat</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
              <i class="ti-receipt menu-icon"></i>
              <span class="menu-title">Manajemen Arsip Keluar</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ asset('assets/pages/charts/chartjs.html') }}">Arsip Surat Keluar</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>