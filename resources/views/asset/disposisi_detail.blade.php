@extends('asset.template')

@section('content')
    <div class="row col-10">
        <div class="col-12 text-center mb-3">
            <h4 class="bg-success text-black py-2 rounded">Detail Disposisi Surat Masuk</h4>
        </div>
        <div id="settings-trigger" title="Kembali ke Data Surat">
            <a href="{{ route('asset.disposisi.index') }}">
                <i class="ti-arrow-left"></i>
            </a>
        </div>

        <div class="col-md-6">
            <div class="card border-info mb-3">
                <div class="card-header bg-info text-white">Detail Disposisi</div>
                <div class="card-body">
                    <h4>Detail Disposisi Surat</h4>
                    <p><strong>No Surat:</strong> {{ $disposisi->surat->no_surat }}</p>
                    <p><strong>Perihal:</strong> {{ $disposisi->surat->perihal }}</p>
                    <p><strong>Asal Surat:</strong> {{ $disposisi->surat->asal_surat }}</p>
                    <p><strong>Tanggal Surat:</strong> {{ $disposisi->surat->tanggal_surat }}</p>
                    <p><strong>Tanggal Disposisi:</strong> {{ $disposisi->tanggal }}</p>
                    <p><strong>Catatan:</strong> {{ $disposisi->catatan }}</p>

                    <hr>

                    <h5>File Surat</h5>
                    <embed src="{{ asset('storage/' . $disposisi->surat->file_surat) }}" width="100%" height="500px"
                        type="application/pdf">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-info mb-3">
                <div class="card-header bg-info text-white">File Surat</div>
                <div class="card-body p-2">
                    <embed src="{{ asset('storage/' . $surat->file_surat) }}" width="100%" height="500px"
                        type="application/pdf">
                </div>
            </div>
        </div>
    </div>
@endsection
