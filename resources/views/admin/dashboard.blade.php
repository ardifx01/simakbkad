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
                              <div onclick="window.location.href='{{ route('admin.dataSuratMasuk') }}'"
                                  class="card text-white gradient-card"
                                  style="cursor: pointer; border-radius: 12px; overflow: hidden; position: relative;">
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
                              <div onclick="window.location.href='{{ route('admin.suratmasuk.selesai') }}'"
                                  class="card text-white gradient-card"
                                  style="cursor: pointer; border-radius: 12px; overflow: hidden; position: relative;">
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
                              <div class="card text-white gradient-card"
                                  style="cursor: default; border-radius: 12px; overflow: hidden; position: relative;">
                                  <div class="card-body d-flex align-items-center justify-content-between">
                                      <div class="d-flex align-items-center">
                                          <img src="{{ asset('assets/images/logo_surat.png') }}" alt="Icon Arsip"
                                              style="width: 48px; height: 48px; margin-right: 15px;" />
                                          <div>
                                              <p class="mb-1" style="font-weight: 600; font-size: 18px;">Total <br> Surat
                                              </p>
                                          </div>
                                      </div>
                                      <h2 class="mb-0" style="font-weight: 700;">{{ $totalSurat }}</h2>
                                  </div>
                              </div>
                          </div>


                          <div class="col-md-3 mb-3">
                              <div onclick="window.location.href='{{ route('admin.users.index') }}'"
                                  class="card text-white gradient-card"
                                  style="cursor: pointer; border-radius: 12px; overflow: hidden; position: relative;">

                                  <div class="card-body d-flex align-items-center justify-content-between">
                                      <div class="d-flex align-items-center">
                                          <img src="{{ asset('assets/images/logo_user.png') }}" alt="Icon User"
                                              style="width: 48px; height: 48px; margin-right: 15px;" />
                                          <div>
                                              <p class="mb-1" style="font-weight: 600; font-size: 18px;">User</p>
                                          </div>
                                      </div>
                                      <h2 class="mb-0" style="font-weight: 700;">{{ $totalPengguna ?? 0 }}</h2>
                                  </div>
                              </div>
                          </div>


                          <div class="row">
                              <!-- Timeline Surat Masuk -->
                              <div class="col-md-6 mb-4">
                                  <div class="card"
                                      style="border-radius: 10px; padding: 5px; 
                                        background: linear-gradient(120deg, #BDC6E9, #7A85C1); 
                                        box-shadow: 0 4px 12px rgba(0,0,0,0.3);">
                                      <h4 class="mt-3" style="margin-left: 1.5rem;">Timeline Surat Masuk</h4>
                                      <h6 class="mb-3"
                                          style="font-style: italic; color: #800025; font-size: 10px; margin-left: 1.5rem;">
                                          * Surat yang sudah selesai otomatis hilang pada hari dimana surat diselesaikan!
                                      </h6>

                                      @forelse ($surats as $surat)
                                          @php
                                              $lastDisposisi = $surat->disposisi->last();
                                              $kepada = $lastDisposisi
                                                  ? array_map('trim', explode(',', $lastDisposisi->kepada_bidang))
                                                  : [];
                                              $adaSekretaris = in_array('Sekretaris', $kepada);
                                              $kabidTujuan = collect($kepada)->first(
                                                  fn($v) => str_contains($v, 'KABID'),
                                              );
                                          @endphp

                                          <div class="d-flex justify-content-center mb-3">
                                              <div class="card col-md-11 p-2 mx-auto">
                                                  <h6 style="font-size: 12px;"><strong>No Surat:</strong>
                                                      {{ $surat->no_surat }}</h6>
                                                  <p style="font-size: 12px;"><strong>Perihal:</strong>
                                                      {{ $surat->perihal }}</p>

                                                  <div class="track">
                                                      <div class="step {{ $surat->status_disposisi ? 'active' : '' }}">
                                                          <span class="circle"></span>
                                                          <span class="label">Kepala Badan</span>
                                                      </div>

                                                      <div
                                                          class="step {{ $adaSekretaris || $surat->status_sekretaris == 'Selesai' ? 'active' : '' }}">
                                                          <span class="circle"></span>
                                                          <span class="label">Sekretaris</span>
                                                      </div>

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
                                                  <i class="bi bi-inbox"></i> Proses surat masuk tidak tersedia / sudah
                                                  selesai!
                                              </p>
                                          </div>
                                      @endforelse
                                  </div>
                              </div>

                              <!-- Bagian Chart (dengan filter di atasnya) -->
                              <div class="col-md-6 mb-4">
                                  <div class="d-flex justify-content-end mb-2">
                                      <!-- Tombol Dropdown Filter -->
                                      <div class="dropdown">
                                          <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                              id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true"
                                              aria-expanded="true"
                                              style="border: 1px solid #838ac1; border-radius: 20px;">
                                              <i class="mdi mdi-calendar"></i>
                                              @if ($filter == 'harian')
                                                  Perhari
                                              @elseif($filter == 'mingguan')
                                                  Perminggu
                                              @elseif($filter == 'bulanan')
                                                  Perbulan
                                              @elseif($filter == 'tanggal')
                                                  Pertanggal
                                              @else
                                                  Pilih Filter
                                              @endif
                                          </button>
                                          <!-- Isi Dropdown -->
                                          <div class="dropdown-menu dropdown-menu-right"
                                              aria-labelledby="dropdownMenuDate2">
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
                                              <a class="dropdown-item" href="#" data-toggle="modal"
                                                  data-target="#filterTanggalModal">
                                                  <i class="bi bi-calendar-date"></i> Pertanggal
                                              </a>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="row">
                                      <!-- Chart Jumlah Surat Masuk -->
                                      <div class="col-md-6 mb-4">
                                          @if (count($data) > 0)
                                              <div class="card">
                                                  <div class="card-body">
                                                      <h4 class="card-title">📊 Jumlah Surat Masuk</h4>
                                                      <canvas id="suratMasukChart" width="100px"
                                                          height="100px"></canvas>
                                                  </div>
                                              </div>
                                          @elseif ($tanggal)
                                              <p class="text-center mt-3"
                                                  style="color: #000; background-color: #addcf5; border-radius: 12px; padding: 3px;">
                                                  Data surat di tanggal {{ $tanggal }} tidak ada!
                                              </p>
                                          @else
                                              <p class="text-center mt-3"
                                                  style="color: #000; background-color: #addcf5; border-radius: 12px; padding: 3px;">
                                                  Data surat tidak ada!
                                              </p>
                                          @endif
                                      </div>

                                      <!-- Chart Kategori Agenda -->
                                      <div class="col-md-6 mb-4">
                                          @if (count($data) > 0)
                                              <div class="card">
                                                  <div class="card-body">
                                                      <h4 class="card-title">📊 Surat per Kategori Agenda</h4>
                                                      <canvas id="chartKategoriAgenda"></canvas>
                                                  </div>
                                              </div>
                                          @elseif ($tanggal)
                                              <p class="text-center mt-3"
                                                  style="color: #000; background-color: #addcf5; border-radius: 12px; padding: 3px;">
                                                  Kategori surat di tanggal {{ $tanggal }} tidak ada!
                                              </p>
                                          @else
                                              <p class="text-center mt-3"
                                                  style="color: #000; background-color: #addcf5; border-radius: 12px; padding: 3px;">
                                                  Kategori surat tidak ada!
                                              </p>
                                          @endif
                                      </div>
                                  </div>
                              </div>
                          </div>



                          <!-- Modal Form Pilih Tanggal -->
                          <div class="modal fade" id="filterTanggalModal" tabindex="-1" role="dialog"
                              aria-labelledby="filterTanggalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-sm" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h6 class="modal-title" id="filterTanggalLabel">Filter Tanggal</h6>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <form action="{{ route('admin.dashboard') }}" method="GET">
                                          <div class="modal-body">
                                              <input type="hidden" name="filter" value="tanggal">
                                              <input type="date" name="tanggal" class="form-control" required>
                                          </div>
                                          <div class="modal-footer">
                                              <button type="submit" class="btn btn-primary btn-sm">Tampilkan</button>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              @include('layout.footer')
          </div>
      @endsection
