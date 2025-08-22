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
                          <div class="col-md-3 mb-3">
                              <div class="card text-white"
                                  style="background-color: #1951b3; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.3);">
                                  <div class="card-body d-flex align-items-center justify-content-between">
                                      <div class="d-flex align-items-center">
                                          <img src="{{ asset('assets/images/2601790.png') }}" alt="Icon Surat"
                                              style="width: 48px; height: 48px; margin-right: 15px;" />
                                          <div>
                                              <p class="mb-1" style="font-weight: 600; font-size: 18px;">Surat Masuk</p>
                                          </div>
                                      </div>
                                      <h2 class="mb-0" style="font-weight: 700;">{{ $totalSuratMasuk ?? 0 }}</h2>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-3 mb-3">
                              <div class="card text-white"
                                  style="background-color: #1951b3; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.3);">
                                  <div class="card-body d-flex align-items-center justify-content-between">
                                      <div class="d-flex align-items-center">
                                          <img src="{{ asset('assets/images/File_Box-128.webp') }}" alt="Icon Arsip"
                                              style="width: 48px; height: 48px; margin-right: 15px;" />
                                          <div>
                                              <p class="mb-1" style="font-weight: 600; font-size: 18px;">Arsip Surat</p>
                                          </div>
                                      </div>
                                      <h2 class="mb-0" style="font-weight: 700;">{{ $totalArsipSurat ?? 0 }}</h2>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-3 mb-3">
                              <div class="card text-white"
                                  style="background-color: #1951b3; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.3);">
                                  <div class="card-body d-flex align-items-center justify-content-between">
                                      <div class="d-flex align-items-center">
                                          <img src="{{ asset('assets/images/logo_surat.png') }}" alt="Icon Arsip"
                                              style="width: 48px; height: 48px; margin-right: 15px;" />
                                          <div>
                                              <p class="mb-1" style="font-weight: 600; font-size: 18px;">Total <br> Surat
                                              </p>
                                          </div>
                                      </div>
                                      <h2 class="mb-0" style="font-weight: 700;">{{ $totalSurat ?? 0 }}</h2>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-3 mb-3">
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

                          <div class="col-md-8 mb-4">
                              <div class="card"
                                  style="border-radius: 10px; padding: 5px; 
                                        background: linear-gradient(120deg, #BDC6E9, #7A85C1); 
                                        box-shadow: 0 4px 12px rgba(0,0,0,0.3);">
                                  <h4 class="mt-3" style="margin-left: 1.5rem;">Timeline Surat Masuk</h4>
                                  <h6 class="mb-3"
                                      style="font-style: italic; 
                                            color: #800025; 
                                            font-size: 10px; 
                                            margin-left: 1.5rem;">
                                      *
                                      Surat yang sudah selesai otomatis hilang pada hari dimana surat diselesaikan!</h6>

                                  @forelse ($surats as $surat)
                                      @php
                                          $lastDisposisi = $surat->disposisi->last();
                                          $kepada = $lastDisposisi
                                              ? array_map('trim', explode(',', $lastDisposisi->kepada_bidang))
                                              : [];
                                          $adaSekretaris = in_array('Sekretaris', $kepada);
                                          $kabidTujuan = collect($kepada)->first(fn($v) => str_contains($v, 'KABID'));
                                      @endphp
                                      {{-- Bungkus dengan flex supaya center --}}
                                      <div class="d-flex justify-content-center mb-3">
                                          <div class="card col-md-11 p-2 mx-auto">
                                              <h6 style="font-size: 12px;"><strong>No Surat:</strong>
                                                  {{ $surat->no_surat }}</h6>
                                              <p style="font-size: 12px;"><strong>Perihal:</strong> {{ $surat->perihal }}
                                              </p>

                                              <div class="track">
                                                  {{-- Kepala Badan --}}
                                                  <div class="step {{ $surat->status_disposisi ? 'active' : '' }}">
                                                      <span class="circle"></span>
                                                      <span class="label">Kepala Badan</span>
                                                  </div>

                                                  {{-- Sekretaris --}}
                                                  <div
                                                      class="step {{ $adaSekretaris || $surat->status_sekretaris == 'Selesai' ? 'active' : '' }}">
                                                      <span class="circle"></span>
                                                      <span class="label">Sekretaris</span>
                                                  </div>

                                                  {{-- Kabid --}}
                                                  @if ($kabidTujuan)
                                                      <div
                                                          class="step {{ $surat->status_sekretaris == 'didistribusikan' && $kabidTujuan ? 'active' : '' }}
                                                                       ">
                                                          <span class="circle"></span>
                                                          <span class="label">{{ $kabidTujuan }}</span>
                                                      </div>
                                                  @else
                                                      <div class="step">
                                                          <span class="circle"></span>
                                                          <span class="label">Kabid</span>
                                                      </div>
                                                  @endif

                                                  {{-- Selesai --}}
                                                  <div
                                                      class="step {{ $surat->status_kabid == 'Selesai' ? 'active' : '' }}">
                                                      <span class="circle"></span>
                                                      <span class="label">Selesai</span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  @empty
                                      <div class="text-center py-4">
                                          <p class="mb-0" style="font-size: 14px; color: #000000;">
                                              <i class="bi bi-inbox"></i> Surat masuk tidak tersedia!
                                          </p>
                                      </div>
                                  @endforelse
                              </div>
                          </div>


                          <div class="col-12 col-xl-4">
                              <div class="justify-content-end d-flex">
                                  <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                      <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                          id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true"
                                          aria-expanded="true" style="border: 1px solid #838ac1; border-radius: 20px;">
                                          <i class="mdi mdi-calendar"></i>
                                          {{ $filter == 'harian' ? 'Perhari' : ($filter == 'mingguan' ? 'Perminggu' : 'Perbulan') }}
                                      </button>
                                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                          <a class="dropdown-item"
                                              href="{{ route('admin.dashboard', ['filter' => 'harian']) }}">
                                              <i class="bi bi-calendar3"></i> Perhari
                                          </a>

                                          <a class="dropdown-item"
                                              href="{{ route('admin.dashboard', ['filter' => 'mingguan']) }}">
                                              <i class="bi bi-calendar-week"></i> Perminggu
                                          </a>

                                          <a class="dropdown-item"
                                              href="{{ route('admin.dashboard', ['filter' => 'bulanan']) }}">
                                              <i class="bi bi-calendar-month"></i> Perbulan
                                          </a>

                                      </div>
                                      <canvas id="suratMasukChart"></canvas>
                                  </div>
                              </div>
                          </div>

                      </div>
                  </div>
              </div>
              @include('layout.footer')
          </div>
      @endsection
