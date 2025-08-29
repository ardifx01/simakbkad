@extends('admin.template1')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 text-center mb-3">
            <h4 class="bg-primary text-white py-2 rounded">Detail Disposisi Surat</h4>
        </div>

        <div id="settings-trigger" title="Kembali ke Data Surat">
            <a href="{{ route('admin.suratmasuk.disposisi') }}">
                <i class="ti-arrow-left"></i>
            </a>
        </div>

        {{-- DETAIL & DISPOSISI --}}
        <div class="col-md-5">
            <div class="card border-info mb-3">
                <div class="card-header bg-info text-white">Detail Surat</div>
                <div class="card-body">
                    <p><strong>No. Surat:</strong> {{ $disposisi->surat->no_surat }}</p>
                    <p><strong>Tanggal Surat:</strong>
                        {{ \Carbon\Carbon::parse($disposisi->surat->tanggal_surat)->format('d F Y') }}</p>
                    <p><strong>Tanggal Masuk:</strong>
                        {{ \Carbon\Carbon::parse($disposisi->surat->tanggal_masuk)->format('d F Y') }}</p>
                    <p><strong>Perihal:</strong> {{ $disposisi->surat->perihal }}</p>
                    <p><strong>Asal Instansi:</strong> {{ $disposisi->surat->asal_surat }}</p>
                    <p><strong>Dari:</strong> {{ $disposisi->dari->nama }}</p>
                    <p><strong>Tujuan:</strong>
                        @foreach (explode(',', $disposisi->kepada_bidang) as $bidang)
                            <span class="badge badge-outline-primary">{{ trim($bidang) }}</span>
                        @endforeach
                    </p>
                    @if ($disposisi->tindakan ?? false)
                        <p><strong>Tindakan:</strong>
                            @foreach (explode(',', $disposisi->tindakan) as $tindakan)
                                <span class="badge badge-info mb-1">{{ trim($tindakan) }}</span>
                            @endforeach
                        </p>
                    @endif
                    <p><strong>Isi Disposisi:</strong><br>
                    <div class="border rounded p-2 bg-light">
                        {!! nl2br(e($disposisi->isi_disposisi)) !!}
                    </div>
                    </p>
                </div>
            </div>
        </div>

        {{-- FILE SURAT --}}
        <div class="col-md-7">
            <div class="card border-info">
                <div class="card-header bg-info text-white">File Surat</div>
                <div class="card-body p-2">
                    <embed src="{{ asset('storage/' . $surat->file_surat) }}" width="100%" height="500px"
                        type="application/pdf">
                </div>
            </div>
        </div>
    </div>
@endsection
