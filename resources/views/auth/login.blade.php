<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SIMAK - BKAD Dairi</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logoDairi.png') }}" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0"
                style="background-image: url('{{ asset('assets/images/bg.jpeg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5"
                            style="background-color: rgba(255, 255, 255, 0.2); backdrop-filter: blur(15px); border-radius: 15px;">
                            <div class="brand-logo">
                                <img src="{{ asset('assets/images/simak.png') }}" alt="logo">
                            </div>
                            <h4>Halo! Mari kita mulai</h4>
                            <h6 class="font-weight-light">Masuk untuk melanjutkan.</h6>
                            <form method="POST" action="{{ route('login.proses') }}">
                                @if (session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                @csrf
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email"
                                        required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password"
                                        required>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                                    <a href="{{ route('landing') }}" class="btn btn-close btn-block">Cancel</a>
                                </div>
                                {{-- <div class="text-center mt-4 font-weight-light">
                                    Belum Punya Akun? <a href="{{ route('register') }}" class="text-primary">Buat
                                        akun!</a>
                                </div> --}}
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <!-- endinject -->
</body>

</html>
