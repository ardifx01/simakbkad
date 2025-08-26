<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SIMAK - BKAD DAIRI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
    <link rel="shortcut icon" href="{{ asset('assets/images/logoDairi.png') }}" />
    <style>
        :root {
            --primary-color: #4688ce;
            --secondary-color: #589faf;
            --dark-color: #0f2027;
            --light-bg-color: #f8f9fa;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: white;
            color: #333;
        }

        .navbar {
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            padding: 1rem 0;
        }

        .navbar-brand img {
            height: 45px;
        }

        .nav-link {
            font-weight: 500;
            color: #333 !important;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .btn-login {
            border-radius: 50px;
            padding: 10px 28px;
            font-weight: 600;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border: none;
            color: white;
            box-shadow: 0 4px 10px rgba(43, 136, 223, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(87, 129, 173, 0.4);
            color: white;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 120px 0;
            text-align: center;
        }

        .hero-section h1 {
            font-weight: 700;
            font-size: 3.5rem;
            margin-bottom: 20px;
        }

        .hero-section p {
            font-size: 1.2rem;
            max-width: 800px;
            margin: 0 auto 30px;
        }

        .btn-cta {
            background-color: white;
            color: var(--primary-color);
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .section-padding {
            padding: 100px 0;
        }

        .feature-card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .feature-card .icon-circle {
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            color: white;
            width: 70px;
            height: 70px;
            line-height: 70px;
            border-radius: 50%;
            font-size: 2rem;
            margin: 0 auto 20px;
            box-shadow: 0 4px 10px #6082a7;
        }

        .feature-card h5 {
            font-weight: 600;
            color: var(--dark-color);
        }

        .about-section h2,
        .contact-section h2 {
            font-weight: 700;
            color: var(--dark-color);
        }

        .about-section .about-image {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            height: auto;
        }

        .other-features-section {
            background-color: var(--light-bg-color);
        }

        .other-features-list {
            list-style: none;
            padding-left: 0;
        }

        .other-features-list li {
            font-size: 1.1rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .other-features-list li i {
            color: var(--primary-color);
            margin-right: 15px;
            font-size: 1.5rem;
        }

        footer {
            background: var(--dark-color);
            color: white;
            text-align: center;
            padding: 20px 0;
            font-size: 0.95rem;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/images/simak.png') }}" alt="SIMSURAT Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav me-3">
                    <li class="nav-item"><a class="nav-link" href="#hero">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#fitur">Fitur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang Kami</a></li>
                </ul>
                <a href="{{ route('login') }}" class="btn btn-login">Login</a>
            </div>
        </div>
    </nav>

    <header id="hero" class="hero-section text-white d-flex align-items-center"
        style="background-color: #0a0f3c; min-height: 100vh; padding: 80px 0; position: relative; overflow: hidden;">
        <div class="container" data-aos="fade-up">
            <div class="row align-items-center">
                <!-- Konten Teks -->
                <div class="col-lg-6 text-center text-lg-start">
                    <h1 class="fw-bold mb-4" style="font-size: 2.8rem; color: #fff;">
                        Manajemen Surat Lebih <span style="color: #f1c40f;">Efisien</span>
                    </h1>
                    <p class="mb-4" style="color: #ccc;">
                        SIMAK (Sistem Informasi Manajemen Arsip & Korespondensi) BKAD Dairi hadir untuk mengelola surat
                        masuk dan keluar
                        dengan lebih cepat, terstruktur, dan transparan.
                    </p>
                    <a href="{{ route('login') }}" class="btn btn-light px-4 py-2 fw-bold"
                        style="border-radius: 50px; color: #0a0f3c; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                        Mulai Sekarang
                    </a>
                </div>

                <div class="col-lg-6 text-center mt-5 mt-lg-0" data-aos="zoom-in">
                    <div style="position: relative; display: inline-block; padding: 20px;">

                        <!-- Shape Abstrak -->
                        <div
                            style="
      position: absolute;
      top: 50%; left: 50%;
      width: 400px; height: 300px;
      background: radial-gradient(circle at 30% 30%, #6bddfa, transparent 70%);
      border-radius: 50% 40% 60% 50% / 50% 60% 40% 50%;
      transform: translate(-50%, -50%) rotate(15deg);
      filter: blur(40px);
      z-index: 1;">
                        </div>

                        <!-- Gambar -->
                        <img src="{{ asset('assets/images/bg1.png') }}" alt="Ilustrasi Surat"
                            class="img-fluid rounded shadow-lg"
                            style="max-height: 340px; position: relative; z-index: 2;">
                    </div>
                </div>
                <div
                    style="position: absolute; top: 0; right: 0; width: 250px; height: 250px; background: radial-gradient(circle, #1f2e78, transparent); border-radius: 50%; opacity: 0.2;">
                </div>
    </header>
    <style>
        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <section id="fitur" class="section-padding bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5" data-aos="fade-up">Fitur Unggulan</h2>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="icon-circle"><i class="bi bi-envelope-open"></i></div>
                        <h5>Manajemen Surat Masuk</h5>
                        <p>Kelola, distribusikan, dan disposisikan surat masuk secara digital dengan mudah dan cepat.
                        </p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="icon-circle"><i class="bi bi-envelope-paper"></i></div>
                        <h5>Pengarsipan Surat Masuk</h5>
                        <p>Pelacakan, dan Pengarsipkan surat masuk dengan sistematis, menghindari kehilangan data.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card">
                        <div class="icon-circle"><i class="bi bi-bell"></i></div>
                        <h5>Notifikasi & Pengingat</h5>
                        <p>Dapatkan pemberitahuan real-time untuk setiap tindak lanjut yang dibutuhkan, sehingga tidak
                            ada yang terlewat.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="tentang" class="section-padding">
        <div class="container">
            <div class="row align-items-center">
                <!-- Gambar -->
                <div class="col-lg-6 mb-4 mb-lg-0 pe-lg-5" data-aos="fade-right">
                    <div id="carouselTentang" class="carousel slide carousel-fade" data-bs-ride="carousel"
                        data-bs-interval="3000">
                        <div class="carousel-inner rounded shadow-sm">
                            <div class="carousel-item active">
                                <img src="{{ asset('assets/images/bkad.webp') }}" class="d-block w-100 img-fluid"
                                    alt="Kantor BKAD Dairi">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/images/bkad2.webp') }}" class="d-block w-100 img-fluid"
                                    alt="Staf BKAD">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Teks -->
                <div class="col-lg-6 ps-lg-4" data-aos="fade-left">
                    <h2 class="mb-4">Tentang SIMAK BKAD Dairi</h2>
                    <p>Sistem Informasi Manajemen Arsip & Korespondensi (SIMAK) adalah solusi digital untuk meningkatkan
                        efisiensi dan
                        transparansi dalam pengelolaan tata naskah dinas di lingkungan Badan Keuangan dan Aset Daerah
                        (BKAD) Kabupaten Dairi. Dengan SIMAK, proses surat-menyurat menjadi lebih cepat, akurat, dan
                        terintegrasi.</p>
                    <p>Kami berkomitmen untuk mendukung digitalisasi birokrasi, mengurangi penggunaan kertas, dan
                        memastikan setiap dokumen penting dapat terlacak dengan mudah.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="pt-3 pb-2" style="background: linear-gradient(135deg, #67a2c9, #6d96c9);
color: #fefeff;
">
        <div class="container" style="max-width: 1140px;">
            <div class="row align-items-start justify-content-between">

                <!-- Hubungi Kami -->
                <div class="col-md-3 mb-4 text-start" style="padding-left:0;">
                    <h5 class="fw-bold mb-3">Hubungi Kami</h5>
                    <ul class="list-unstyled" style="margin-left: -10px;">
                        <li class="mb-3 d-flex align-items-center">
                            <img src="/assets/images/whatsapp.png" alt="WhatsApp" width="24" class="me-2">
                            <a href="https://web.whatsapp.com/" target="_blank"
                                class="text-light text-decoration-none" style="font-size:16px;">
                                +628136464747
                            </a>
                        </li>
                        <li class="d-flex align-items-center">
                            <img src="/assets/images/gmail.png" alt="Email" width="24" class="me-2">
                            <a href="mailto:bkaddairi@gmail.com" target="_blank"
                                class="text-light text-decoration-none" style="font-size:16px;">
                                bkaddairi@gmail.com
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Alamat Kantor -->
                <div class="col-md-5 mb-4 text-center">
                    <h5 class="fw-bold mb-3">Alamat Kantor</h5>
                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-center gap-3">
                        <!-- Peta -->
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3985.2320167454254!2d98.3115856735954!3d2.747477097229727!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x303037e159f9aba1%3A0x3bf718031e5ced86!2sBadan%20Keuangan%20dan%20Aset%20Daerah%20(BKAD)%20Kabupaten%20Dairi!5e0!3m2!1sid!2sid!4v1754293414849!5m2!1sid!2sid"
                            width="150" height="150" style="border:0; border-radius: 10px;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                        <!-- Teks Alamat -->
                        <div style="max-width: 280px;">
                            <p class="mb-0 text-start" style="line-height: 1.6; font-size:15px;">
                                Jl. Sisingamangaraja No.127, Kec. Sidikalang,<br>
                                Kabupaten Dairi, Sumatera Utara 22218
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Media Sosial -->
                <div class="col-md-3 mb-4 ps-md-5">
                    <h5 class="fw-bold mb-3">Media Sosial Kami</h5>
                    <div class="d-flex flex-column gap-3">
                        <ul class="list-unstyled">
                            <li class="mb-2 d-flex align-items-center">
                                <img src="/assets/images/instagram.png" alt="Instagram" width="30"
                                    class="me-2">
                                <a href="https://www.instagram.com/bkad_kabdairi/" target="_blank"
                                    class="text-light text-decoration-none" style="font-size:16px;">
                                    bkad_kabdairi
                                </a>
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="/assets/images/facebook.png" alt="Facebook" width="30" class="me-2">
                                <a href="https://www.facebook.com/profile.php?id=61576860890036" target="_blank"
                                    class="text-light text-decoration-none" style="font-size:16px;">
                                    bkad_kabdairi
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="text-center py-3 shadow-lg text-white fw-bold"
        style="background: linear-gradient(135deg, #74a3c2, #3f5c80);
); 
        font-size: 1.1rem; z-index: 999;">
        <small class="d-inline-block">
            <i class="bi bi-c-circle me-1 text-white"></i>
            2025 <span style="letter-spacing: 0.5px;">SIMAK – Kantor BKAD Kabupaten Dairi</span>
        </small>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 800
        });
    </script>
</body>

</html>
