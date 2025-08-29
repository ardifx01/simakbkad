  @extends('sekretaris.template')
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
                              <h3 class="font-weight-bold">Halo {{ $user->nama }}..</h3>
                              <h6 class="font-weight-normal mb-0">{{ $greeting }}
                                  <span class="text-primary">Tetap Semangat!</span>
                              </h6>
                          </div>


                      </div>
                  </div>
              </div>
              <div class="row">
                  <!-- Timeline Surat Masuk -->
                  <div class="col-md-8 grid-margin transparent">
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
                              * Surat yang sudah selesai otomatis hilang pada hari dimana surat diselesaikan!
                          </h6>

                          @forelse ($surats as $surat)
                              @php
                                  $lastDisposisi = $surat->disposisi->last();
                                  $kepada = $lastDisposisi
                                      ? array_map('trim', explode(',', $lastDisposisi->kepada_bidang))
                                      : [];
                                  $adaSekretaris = in_array('Sekretaris', $kepada);
                                  $kabidTujuan = collect($kepada)->first(fn($v) => str_contains($v, 'KABID'));
                              @endphp
                              <div class="d-flex justify-content-center mb-3">
                                  <div class="card col-md-11 p-2 mx-auto">
                                      <h6 style="font-size: 12px;"><strong>No Surat:</strong>
                                          {{ $surat->no_surat }}</h6>
                                      <p style="font-size: 12px;"><strong>Perihal:</strong>
                                          {{ $surat->perihal }}</p>

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
                                                  class="step {{ $surat->status_sekretaris == 'didistribusikan' && $kabidTujuan ? 'active' : '' }}">
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
                                          <div class="step {{ $surat->status_kabid == 'Selesai' ? 'active' : '' }}">
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

                  <!-- Card Statistik Surat -->
                  <div class="col-md-4 grid-margin">
                      <div class="row">
                          <!-- Surat Belum Didisposisikan -->
                          <div class="col-md-12 mb-3">
                              <div onclick="window.location.href='{{ route('sekretaris.dataSuratMasuk') }}'"
                                  class="card text-white gradient-card"
                                  style="cursor: pointer; border-radius: 12px; overflow: hidden; position: relative;">
                                  <div class="card text-white"
                                      style="background-color: #1951b3; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.3);">
                                      <div class="card-body d-flex align-items-center justify-content-between">
                                          <div class="d-flex align-items-center">
                                              <img src="{{ asset('assets/images/2601790.png') }}" alt="Icon Surat"
                                                  style="width: 48px; height: 48px; margin-right: 15px;" />
                                              <div>
                                                  <p class="mb-1" style="font-weight: 600; font-size: 18px;">
                                                      Surat yang <br> belum didistribusikan
                                                  </p>
                                              </div>
                                          </div>
                                          <h2 class="mb-0" style="font-weight: 700;">{{ $belumDistribusi ?? 0 }}
                                          </h2>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <!-- Surat Sudah Didisposisikan -->
                          <div class="col-md-12 mb-3">
                              <div onclick="window.location.href='{{ route('sekretaris.suratmasuk.selesai') }}'"
                                  class="card text-white gradient-card"
                                  style="cursor: pointer; border-radius: 12px; overflow: hidden; position: relative;">
                                  <div class="card text-white"
                                      style="background-color: #1951b3; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.3);">
                                      <div class="card-body d-flex align-items-center justify-content-between">
                                          <div class="d-flex align-items-center">
                                              <img src="{{ asset('assets/images/File_Box-128.webp') }}" alt="Icon Surat"
                                                  style="width: 48px; height: 48px; margin-right: 15px;" />
                                              <div>
                                                  <p class="mb-1" style="font-weight: 600; font-size: 18px;">
                                                      Arsip Surat
                                                  </p>
                                              </div>
                                          </div>
                                          <h2 class="mb-0" style="font-weight: 700;">{{ $totalArsipSurat ?? 0 }}
                                          </h2>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  @include('layout.footer')
              </div>
          </div>
      @endsection
