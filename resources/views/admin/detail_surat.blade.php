@extends('admin.template')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 mb-4 text-center">
        <h4 class="bg-primary text-white py-3 px-4 rounded shadow-sm d-inline-block">📄 Detail Surat Masuk</h4>
    </div>

    <div class="col-12 mb-3">
        <a href="{{ route('admin.dataSuratMasuk') }}" class="btn btn-sm btn-outline-secondary">
            <i class="ti-arrow-left"></i> Kembali ke Data Surat
        </a>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-info text-white">
                <strong>📝 Detail Surat</strong>
            </div>
            <div class="card-body">
                <p><strong>No. Surat:</strong><br>{{ $surat->no_surat }}</p>
                <p><strong>Tanggal Surat:</strong><br>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d F Y') }}</p>
                <p><strong>Tanggal Diterima:</strong><br>{{ \Carbon\Carbon::parse($surat->tanggal_masuk)->format('d F Y') }}</p>
                <p><strong>Perihal:</strong><br>{{ $surat->perihal }}</p>
                <p><strong>Asal Instansi:</strong><br>{{ $surat->asal_surat }}</p>
                <p><strong>Sifat Surat:</strong><br>{{ $surat->sifat }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-info text-white">
                <strong>📎 Preview Surat</strong>
            </div>
            <div class="card-body text-center" style="min-height: 300px;">
                @php
                    $ext = pathinfo($surat->file_surat, PATHINFO_EXTENSION);
                @endphp

                @if(in_array(strtolower($ext), ['pdf']))
                    <embed src="{{ $surat->file_surat }}" width="100%" height="500px" type="application/pdf">
                @elseif(in_array(strtolower($ext), ['jpg', 'jpeg', 'png']))
                    <img src="{{ $surat->file_surat }}" class="img-fluid rounded border" alt="Preview Surat">
                @else
                    <p class="text-muted">File tidak dapat ditampilkan.</p>
                    <a href="{{ $surat->file_surat }}" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="ti-download"></i> Download File
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
