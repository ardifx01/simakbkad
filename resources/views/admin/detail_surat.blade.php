@extends('admin.template')
@section('content')
    <div class="row col-10">
        <div class="col-12 text-center mb-3">
            <h4 class="bg-primary text-white py-2 rounded">Halaman Detail Surat Masuk</h4>
        </div>

        <div id="settings-trigger" title="Kembali ke Data Surat">
            <a href="{{ route('admin.dataSuratMasuk') }}">
                <i class="ti-arrow-left"></i>
            </a>
        </div>

        <div class="col-md-4">
            <div class="card border-info mb-3">
                <div class="card-header bg-info text-white">Detail Surat</div>
                <div class="card-body">
                    <p><strong>No. Surat:</strong> {{ $surat->no_surat }}</p>
                    <p><strong>Tanggal Surat:</strong> {{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d F Y') }}
                    </p>
                    <p><strong>Tanggal Diterima:</strong>
                        {{ \Carbon\Carbon::parse($surat->tanggal_masuk)->format('d F Y') }}</p>
                    <p><strong>Perihal:</strong> {{ $surat->perihal }}</p>
                    <p><strong>Asal Instansi:</strong> {{ $surat->asal_surat }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-info mb-3">
                <div class="card-header bg-info text-white">Tampilan Surat</div>
                <div class="card-body p-2">
                    <embed src="{{ asset('storage/' . $surat->file_surat) }}" width="100%" height="500px"
                        type="application/pdf">
                </div>
            </div>
        </div>
    </div>
@endsection
