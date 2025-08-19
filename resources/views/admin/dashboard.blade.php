  @extends('admin.template')
  @section('content')
      <div class="main-panel">
          <div class="content-wrapper">
              <div class="row">
                  <div class="col-md-12 grid-margin">
                      <div class="row">
                          @php
                              $user = auth()->user();
                              $hour = now()->format('H');
                              if ($hour >= 5 && $hour < 12) {
                                  $greeting = 'Selamat Pagi';
                              } elseif ($hour >= 12 && $hour < 15) {
                                  $greeting = 'Selamat Siang';
                              } elseif ($hour >= 15 && $hour < 18) {
                                  $greeting = 'Selamat Sore';
                              } else {
                                  $greeting = 'Selamat Malam';
                              }
                          @endphp

                          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                              <h3 class="font-weight-bold">Dashboard Admin</h3>
                              {{-- <h3 class="font-weight-bold">Halo {{ $user->nama }}..</h3> --}}
                              <h6 class="font-weight-normal mb-0">{{ $greeting }} 
                                  <span class="text-primary mb-5">{{ $user->nama }}</span>
                              </h6>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12 grid-margin transparent">
                      <div class="row">
                          <div class="col-md-4 mb-4">
                              <div class="card text-white"
                                  style="background-color: #1951b3; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.3);">
                                  <div class="card-body d-flex align-items-center justify-content-between">
                                      <div class="d-flex align-items-center">
                                          <img src="{{ asset('assets/images/logo_surat.png') }}" alt="Icon Surat"
                                              style="width: 48px; height: 48px; margin-right: 15px;" />
                                          <div>
                                              <p class="mb-1" style="font-weight: 600; font-size: 18px;">Surat Masuk</p>
                                          </div>
                                      </div>
                                      <h2 class="mb-0" style="font-weight: 700;">{{ $totalSuratMasuk ?? 0 }}</h2>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-4 mb-4">
                              <div class="card text-white"
                                  style="background-color: #1951b3; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.3);">
                                  <div class="card-body d-flex align-items-center justify-content-between">
                                      <div class="d-flex align-items-center">
                                          <img src="{{ asset('assets/images/logo_arsip.png') }}" alt="Icon Arsip"
                                              style="width: 48px; height: 48px; margin-right: 15px;" />
                                          <div>
                                              <p class="mb-1" style="font-weight: 600; font-size: 18px;">Arsip Surat</p>
                                          </div>
                                      </div>
                                      <h2 class="mb-0" style="font-weight: 700;">{{ $totalSuratMasuk ?? 0 }}</h2>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-4 mb-4">
                              <div class="card text-white"
                                  style="background-color: #1951b3; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.3);">
                                  <div class="card-body d-flex align-items-center justify-content-between">
                                      <div class="d-flex align-items-center">
                                          <img src="{{ asset('assets/images/logo_user.png') }}" alt="Icon Barang"
                                              style="width: 48px; height: 48px; margin-right: 15px;" />
                                          <div>
                                              <p class="mb-1" style="font-weight: 600; font-size: 18px;">User</p>
                                          </div>
                                      </div>
                                      <h2 class="mb-0" style="font-weight: 700;">{{ $totalPengguna ?? 0 }}</h2>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-5 mb-4">
                              <div class="card" style="border-radius: 8px; padding: 20px;">
                                  <h5>Surat Masuk Per Hari</h5>
                                  <canvas id="suratMasukChart"></canvas>
                              </div>
                          </div>

                      </div>
                  </div>
              </div>
              {{-- @include('layout.footer') --}}
          </div>
      @endsection
