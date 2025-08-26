    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo mr-5" href="#"><img src="{{ asset('assets/images/simak.png') }}"
                    class="mr-2" alt="logo" /></a>
            <a class="navbar-brand brand-logo-mini" href="#"><img src="{{ asset('assets/images/logoDairi.png') }}"
                    alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
            <ul class="navbar-nav mr-lg-2">
                <li class="nav-item nav-search d-none d-lg-block">
                    <div class="input-group mt-3">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center"
                                role="alert">
                                <img src="{{ asset('assets/images/check.webp') }}" alt="cek" width="20"
                                    height="20" class="me-2 mr-2">
                                <span> {{ session('success') }}</span>
                                <button type="button" class="close ms-auto" data-dismiss="alert" aria-label="Tutup">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('info'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <img src="{{ asset('assets/images/check.webp') }}" alt="cek" width="20"
                                    height="20" class="me-2 mr-2">
                                <span> {{ session('info') }}</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        {{-- Pesan Error dari Validasi --}}
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <img src="{{ asset('assets/images/warning.png') }}" alt="cek"
                                            width="20" height="20" class="me-2 mr-2">
                                        <span> {{ $error }} <br> </span>
                                        {{-- {{ $error }} <br> --}}
                                    @endforeach
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">

                <li class="nav-item">
                    <span id="world-clock"
                        style="font-weight:bold; font-size:14px; border: 1px solid #001789; padding: 3px 6px; border-radius: 6px; background:#f8f9fa;">
                        <i class="bi bi-clock"></i> <span id="clock-text"></span>
                    </span>

                </li>

                {{-- <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                    aria-labelledby="notificationDropdown">
                    <p class="mb-0 font-weight-normal float-left dropdown-header">Histori Login</p>

                    @forelse($loginHistories as $history)
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-info">
                                    <i class="ti-user mx-0"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject font-weight-normal">
                                    {{ $history->user->nama }}
                                </h6>
                                <p class="font-weight-light small-text mb-0 text-muted">
                                    {{ $history->login_at->format('d-m-Y H:i:s') }}
                                    | {{ $history->ip_address }}
                                </p>
                            </div>
                        </a>
                    @empty
                        <p class="text-center text-muted p-2">Belum ada histori login</p>
                    @endforelse
                    
                </div> --}}


                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-toggle="dropdown"
                        id="profileDropdown">
                        <span class="mr-2 d-none d-lg-inline text-black small px-2 py-1 rounded"
                            style="border: 1px solid #333; background-color: #f0f0f0; display: inline-block; text-align: left;">

                            {{-- Nama User --}}
                            <div class="fw-bold mb-0" style="font-size: 14px; line-height: 1.2;">
                                {{ Auth::user()->nama }}
                            </div>

                            {{-- Role User --}}
                            <div class="text-muted mt-0" style="font-size: 12px; line-height: 1.1;">
                                <b>{{ Auth::user()->role->nama_role }}</b>
                            </div>
                        </span>


                        {{-- Icon user --}}
                        <i class="ti-user mx-0" style="font-size: 22px;" alt="profile"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <a href="#" class="dropdown-item" onclick="event.preventDefault(); showLogoutLoading();">
                            <i class="ti-power-off text-primary"></i> Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>

            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
                <span class="icon-menu"></span>
            </button>
        </div>
    </nav>
    @push('waktu')
        <script>
            function updateClock() {
                const options = {
                    timeZone: 'Asia/Jakarta',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                };

                const now = new Date().toLocaleTimeString('en-GB', options);
                document.getElementById('clock-text').innerText = now;
            }

            setInterval(updateClock, 1000);
            updateClock();
        </script>
    @endpush
    <!-- Modal Profil -->
    {{-- <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-top-right" role="document">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h5 class="modal-title" id="profileModalLabel">Profil Saya</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <p><strong>Nama:</strong> {{ Auth::user()->nama }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Role:</strong> {{ Auth::user()->role->nama_role }}</p>
                    <hr> --}}
    {{-- <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-primary btn-block">Edit Profil</a> --}}
    {{-- <a href="#" class="btn btn-sm btn-primary btn-block">Edit Profil</a>
                </div>
            </div>
        </div>
    </div> --}}
