   @extends('anggaran.template')
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
                   <!-- Card Statistik Surat -->
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <!-- Surat Belum Didisposisikan -->
                        <div class="col-md-4 mb-3">
                            <div onclick="window.location.href='{{ route('asset.disposisi.index') }}'"
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
                                                    Surat Masuk Belum Ditindaklanjuti
                                                </p>
                                            </div>
                                        </div>
                                        <h2 class="mb-0" style="font-weight: 700;">{{ $surat ?? 0 }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Surat Sudah Didisposisikan -->
                        <div class="col-md-4 mb-3">
                            <div onclick="window.location.href='{{ route('asset.suratmasuk.selesai') }}'"
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
                                                    Arsip Surat <br>& Disposisi
                                                </p>
                                            </div>
                                        </div>
                                        <h2 class="mb-0" style="font-weight: 700;">{{ $arsip ?? 0 }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="card text-white gradient-card"
                                style="cursor: pointer; border-radius: 12px; overflow: hidden; position: relative;">
                                <div class="card text-white"
                                    style="background-color: #1951b3; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.3);">
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('assets/images/2601790.png') }}" alt="Icon Surat"
                                                style="width: 48px; height: 48px; margin-right: 15px;" />
                                            <div>
                                                <p class="mb-1" style="font-weight: 600; font-size: 18px;">
                                                    Total Surat
                                                </p>
                                            </div>
                                        </div>
                                        <h2 class="mb-0" style="font-weight: 700;">{{ $total ?? 0 }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               </div>

              @include('layout.footer')
           </div>
       @endsection
