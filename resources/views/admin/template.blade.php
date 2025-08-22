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
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logoDairi.png') }}" />
    <!-- Tambahkan di <head> -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <style>
        .table td {
            white-space: normal !important;
            word-wrap: break-word;
        }

        .track {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
            position: relative;
        }

        .track::before {
            content: '';
            position: absolute;
            top: 4px;
            left: 0;
            right: 0;
            height: 2px;
            background: #dcdcdc;
            z-index: 1;
        }

        .step {
            position: relative;
            text-align: center;
            width: 100%;
            z-index: 2;
        }

        .step .circle {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #dcdcdc;
            margin: 0 auto;
            display: block;
        }

        .step.active .circle {
            /* background: #007bff; */
            background-color: #2563EB;
            animation: pulse-glow 2s infinite;
        }

        @keyframes pulse-glow {
            0% {
                box-shadow: 0 0 5px #2563EB, 0 0 10px #3B82F6, 0 0 15px #60A5FA;
            }

            50% {
                box-shadow: 0 0 15px #2563EB, 0 0 30px #3B82F6, 0 0 45px #60A5FA;
            }

            100% {
                box-shadow: 0 0 5px #2563EB, 0 0 10px #3B82F6, 0 0 15px #60A5FA;
            }
        }

        .step .label {
            margin-top: 8px;
            display: block;
            font-size: 10px;
            font-weight: 600;
            color: #999;
        }

        .step.active .label {
            color: #007bff;
        }
    </style>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

</head>

<body>

    <!-- Overlay animasi logout -->
    <div id="logout-loading"
        style="display: none; position: fixed; top:0; left:0; width:100%; height:100%; 
            background: rgba(0,0,0,0.5); z-index:9999; 
            justify-content:center; align-items:center;">
        <lottie-player src="{{ asset('lottie/loading.json') }}" background="transparent" speed="0.5"
            style="width: 400px; height: 400px;" loop autoplay>
        </lottie-player>
    </div>

    <div class="container-scroller">

        {{-- BAGIAN NAVBAR --}}
        @include('layout.navbar')

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">

            {{-- BAGIAN SIDEBAR --}}
            @include('admin.sidebar')
            {{-- @include('layout.template') --}}

            @yield('content')
        </div>
    </div>

    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/js/file-upload.js') }}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="PPasset('assets/js/Chart.roundedBarCharts.js')"></script>
    <!-- End custom js for this page-->
    <!-- Tambahkan sebelum </body> -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script>
        new TomSelect("#jenis_surat", {
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
    </script>

    <!-- JQuery & DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#suratTable').DataTable({
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Cari...",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    zeroRecords: "Data tidak ditemukan",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    infoEmpty: "Data kosong",
                    paginate: {
                        previous: "Sebelumnya",
                        next: "Berikutnya"
                    }
                }
            });
        });
    </script>
    <script>
        // Tunggu 2 detik (2000ms), lalu sembunyikan alert-nya
        setTimeout(function() {
            let alert = document.querySelector('.alert');
            if (alert) {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 500); // Hapus dari DOM setelah fade
            }
        }, 2000);
    </script>
    <script>
        // Ketika baris diklik, arahkan ke link detail surat
        document.addEventListener("DOMContentLoaded", function() {
            const rows = document.querySelectorAll(".clickable-row");
            rows.forEach(row => {
                row.addEventListener("click", function() {
                    const url = this.getAttribute("data-href");
                    if (url) {
                        window.location.href = url;
                    }
                });
            });
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('suratMasukChart').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, '#AAB1DC');
        gradient.addColorStop(0.5, '#7A85C1');
        gradient.addColorStop(1, '#4F568B');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Jumlah Surat Masuk',
                    data: @json($data),
                    backgroundColor: gradient,
                    borderColor: '#4F568B',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>





    <!-- Panggil Lottie player script -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <!-- Script -->
    <script>
        function showLogoutLoading() {
            let overlay = document.getElementById('logout-loading');
            overlay.style.display = 'flex'; // tampilkan overlay

            setTimeout(function() {
                document.getElementById('logout-form').submit();
            }, 1500); // delay biar animasi terlihat
        }
    </script>


</body>

</html>
