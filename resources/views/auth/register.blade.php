<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<<<<<<< HEAD
    <title>SIMAK - BKAD DAIRI</title>
=======
    <title>SIMAK - BKAD Dairi</title>
>>>>>>> 57856b60c377975f6c3b655989809d5d81dbb99b
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
                            <h4>Buat Akun Baru?</h4>
                            <h6 class="font-weight-light">Mendaftar itu mudah. Hanya membutuhkan beberapa langkah</h6>
                            <form class="pt-3" method="POST" action="{{ route('register.store') }}">
                                @csrf

                                {{-- Nama --}}
                                <div class="form-group">
                                    <input type="text" name="nama" value="{{ old('nama') }}"
                                        class="form-control form-control-lg" placeholder="Nama Lengkap">
                                    @error('nama')
                                        <label style="color:red">{{ $message }}</label>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div class="form-group">
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        class="form-control form-control-lg" placeholder="Email">
                                    @error('email')
                                        <label style="color:red">{{ $message }}</label>
                                    @enderror
                                </div>

                                {{-- Role --}}
                                <div class="form-group">
                                    <select name="role_id" class="form-control form-control-lg">
                                        <option value="">-- Pilih Role / Bidang --</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                                {{ $role->nama_role }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <label style="color:red">{{ $message }}</label>
                                    @enderror
                                </div>

                                {{-- Password --}}
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg"
                                        placeholder="Password">
                                    @error('password')
                                        <label style="color:red">{{ $message }}</label>
                                    @enderror
                                </div>

                                {{-- Tombol Submit --}}
                                <div class="mt-3">
                                    <button type="submit"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                        Buat Akun
                                    </button>
                                </div>

                                {{-- Link ke login --}}
                                <div class="text-center mt-4 font-weight-light">
                                    Sudah punya akun? <a href="{{ route('login') }}" class="text-primary">Masuk</a>
                                </div>
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
