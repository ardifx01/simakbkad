@extends('admin.template1')

@section('content')
    <div class="container-fluid px-4">
        <div class="row">

            {{-- Tombol kembali --}}
            <div class="col-12 mb-3">
                <div id="settings-trigger" title="Kembali ke Data Surat">
                    <a href="{{ route('admin.dataSuratMasuk') }}">
                        <i class="ti-arrow-left"></i>
                    </a>
                </div>
            </div>

            {{-- Detail Surat (Kiri) --}}
            <div class="col-lg-4 col-md-5 mb-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header text-white" style="background-color: #4f7ba2;">
                        <strong>📝 Detail Surat</strong>
                    </div>
                    <div class="card-body">
                        <p><strong>No. Surat:</strong><br>{{ $surat->no_surat }}</p>
                        <p><strong>Tanggal
                                Surat:</strong><br>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d F Y') }}</p>
                        <p><strong>Tanggal
                                Diterima:</strong><br>{{ \Carbon\Carbon::parse($surat->tanggal_masuk)->format('d F Y') }}
                        </p>
                        <p><strong>Perihal:</strong><br>{{ $surat->perihal }}</p>
                        <p><strong>Asal Instansi:</strong><br>{{ $surat->asal_surat }}</p>
                        <p><strong>Sifat Surat:</strong><br>{{ $surat->sifat }}</p>
                    </div>
                </div>
            </div>

            {{-- Preview Surat (Kanan) --}}
            <div class="col-lg-8 col-md-7 mb-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header text-white" style="background-color: #4f7ba2;">
                        <strong>📎 Preview Surat</strong>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center" style="min-height: 500px;">
                        <embed src="{{ asset('storage/' . $surat->file_surat) }}" type="application/pdf" width="100%"
                            height="500px" />
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
