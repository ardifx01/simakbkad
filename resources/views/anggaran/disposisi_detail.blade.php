@extends('anggaran.template')

@section('content')
    <div class="row col-10">
        <div class="col-12 text-center mb-3">
            <h4 class="bg-success text-black py-2 rounded">Detail Disposisi Surat Masuk</h4>
        </div>
        <div id="settings-trigger" title="Kembali ke Data Surat">
            <a href="{{ route('anggaran.disposisi.index') }}">
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
                    @if ($disposisi->tindakan ?? false)
                        <p><strong>Tindakan:</strong>
                            @foreach (explode(',', $disposisi->tindakan) as $tindakan)
                                <span class="badge badge-info mb-1">{{ trim($tindakan) }}</span>
                            @endforeach
                        </p>
                    @endif
                    <p><strong>Isi Disposisi dari Kepala Badan:</strong></p>
                    <div class="border p-2 bg-light rounded">
                        {{ $disposisi->isi_disposisi }}
                    </div>
                    <p><strong>Isi Catatan dari Sekretaris:</strong></p>
                     <div class="border p-2 bg-light rounded">
                        {{ $distribusi->catatan_sekretaris ?? '-' }}
                    </div>
                    {{-- Tombol Selesai --}}
                    <div class="mt-3">
                        <a href="{{ route('kabid.disposisi.selesai', $disposisi->surat->id) }}" class="btn btn-success"
                            onclick="return confirm('Yakin terima surat?')">
                            <i class="ti-check"></i> Selesai
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-info mb-3">
                <div class="card-header bg-info text-white">File Surat</div>
                <div class="card-body p-2">
                    <embed src="{{ asset('storage/' . $surat->file_surat) }}" type="application/pdf" width="100%"
                            height="500px" />
                </div>
            </div>
        </div>
    </div>
@endsection
