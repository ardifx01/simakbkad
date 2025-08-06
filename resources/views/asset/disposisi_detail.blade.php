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
                    <p><strong>Surat Dari:</strong> {{ $disposisi->surat->asal_surat }}</p>
                    <p><strong>Nomor:</strong> {{ $disposisi->surat->no_surat }}</p>
                    <p><strong>Tanggal Surat:</strong>
                        {{ \Carbon\Carbon::parse($disposisi->surat->tanggal_surat)->format('d F Y') }}</p>
                    <p><strong>No. Agenda:</strong> {{ $disposisi->surat->no_agenda }}</p>
                    <p><strong>Tanggal Masuk:</strong>
                        {{ \Carbon\Carbon::parse($disposisi->surat->tanggal_masuk)->format('d F Y') }}</p>
                    <p><strong>Perihal:</strong> {{ $disposisi->surat->perihal }}</p>
                    <p><strong>Tujuan Bidang:</strong>
                        @foreach (explode(',', $disposisi->kepada_bidang) as $bidang)
                            <span class="badge badge-primary">{{ $bidang }}</span>
                        @endforeach
                    </p>
                    @if ($disposisi->tindakan ?? false)
                        <p><strong>Tindakan:</strong>
                            @foreach (explode(',', $disposisi->tindakan) as $tindakan)
                                <span class="badge badge-info mb-1">{{ trim($tindakan) }}</span>
                            @endforeach
                        </p>
                    @endif
                    <p><strong>Isi Disposisi:</strong></p>
                    <div class="border p-2 bg-light rounded">
                        {{ $disposisi->isi_disposisi }}
                    </div>
                    <div class="mt-3 text-end">
                        <a href="{{ route('asset.tindaklanjut.create', $disposisi->id) }}" class="btn btn-success">
                            <i class="ti-pencil-alt"></i> Tindak Lanjut
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-info mb-3">
                <div class="card-header bg-info text-white">File Surat</div>
                <div class="card-body p-2">
                    <embed src="{{ asset('storage/' . file_surat) }}" width="100%" height="500px"
                        type="application/pdf">
                </div>
            </div>
        </div>
    </div>
@endsection
