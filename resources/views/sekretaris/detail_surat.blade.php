@extends('sekretaris.template')

@section('content')
    <div class="row col-10">
        <div id="settings-trigger" title="Kembali">
            <a href="{{ route('sekretaris.dataSuratMasuk') }}">
                <i class="ti-arrow-left"></i>
            </a>
        </div>

        {{-- KOLOM KIRI --}}
        <div class="col-md-5">
            {{-- DETAIL SURAT --}}
            <div class="card border-info mb-3">
                {{-- <div class="card-header bg-primary text-white">Detail Surat</div> --}}
                <div class="card-header text-white" style="background-color: #4f7ba2;">Detail Surat</div>

                <div class="card-body">
                    <p><strong>Surat Dari:</strong> {{ $surat->asal_surat }}</p>
                    <p><strong>Nomor:</strong> {{ $surat->no_surat }}</p>
                    <p><strong>Tanggal Surat:</strong> {{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d F Y') }}
                    </p>
                    <p><strong>No. Agenda:</strong> {{ $surat->no_agenda }}</p>
                    <p><strong>Tanggal Masuk:</strong> {{ \Carbon\Carbon::parse($surat->tanggal_masuk)->format('d F Y') }}
                    </p>
                    <p><strong>Perihal:</strong> {{ $surat->perihal }}</p>
                </div>
            </div>
            @if ($disposisiKaban)
                <div class="card border-primary mb-3">
                    <div class="card-header text-white" style="background-color: #4f7ba2;">Disposisi dari Kepala Badan</div>
                    <div class="card-body">
                        <p><strong>Kepada:</strong> {{ $disposisiKaban->kepada_bidang }}</p>
                        <p><strong>Catatan:</strong> {{ $disposisiKaban->isi_disposisi }}</p>
                        <p><strong>Tindakan:</strong> {{ $disposisiKaban->tindakan }}</p>
                    </div>
                </div>
            @endif

            {{-- FORM CATATAN SEKRETARIS --}}
            <div class="card border-warning mb-3">
                <div class="card-header text-white" style="background-color: #4f7ba2;">Distribusikan Surat</div>
                <div class="card-body">
                        <form action="{{ route('sekretaris.distribusi.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="surat_id" value="{{ $surat->id }}">

                        {{-- Catatan Sekretaris --}}
                        <div class="form-group">
                            <label for="catatan">Catatan Sekretaris</label>
                            <textarea name="catatan" id="catatan" class="form-control" rows="3" required></textarea>
                        </div>

                        {{-- Pilihan Bidang --}}
                        <div class="form-group">
                            <label>Pilih Bidang Tujuan:</label><br>
                            @php
                                $bidangs = [
                                    'KABID AKUNTANSI',
                                    'KABID PENGANGGARAN',
                                    'KABID BMD',
                                    'KABID PEMBENDAHARAAN',
                                ];
                            @endphp
                            @foreach ($bidangs as $bidang)
                                <div class="form-check">
                                    <input type="checkbox" name="kepada_bidang[]" value="{{ $bidang }}"
                                        class="form-check-input" id="{{ $bidang }}">
                                    <label class="form-check-label" for="{{ $bidang }}">{{ $bidang }}</label>
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-info">Kirim Distribusi</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN --}}
        <div class="col-md-7">
            <div class="card border-info mb-3">
                <div class="card-header text-white" style="background-color: #4f7ba2;">File Surat</div>
                <div class="card-body p-2">
                    <embed src="{{ asset('storage/' . $surat->file_surat) }}" width="100%" height="500px"
                        type="application/pdf">
                </div>
            </div>
        </div>
    </div>
@endsection
