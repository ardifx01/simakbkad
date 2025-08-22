@extends('kepala.template')

@section('content')
    <div class="row col-10">

        <div id="settings-trigger" title="Kembali ke Data Surat">
            <a href="{{ route('kepala.dataSuratMasuk') }}">
                <i class="ti-arrow-left"></i>
            </a>
        </div>

        {{-- FORM DISPOSISI + DETAIL SURAT --}}
        <div class="col-12">
            <div class="card border-info shadow-lg">
                <div class="card-header bg-info text-white">
                    <strong>Disposisi Surat</strong>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('kepala.suratmasuk.disposisi') }}">
                        @csrf
                        <input type="hidden" name="surat_id" value="{{ $surat->id }}">

                        <div class="row">
                            {{-- === DETAIL SURAT (KIRI) === --}}
                            <div class="col-md-6 border-right">
                                <p><strong>Asal Surat:</strong> {{ $surat->asal_surat }}</p>
                                <p><strong>No. Surat:</strong> {{ $surat->no_surat }}</p>
                                <p><strong>Tanggal Surat:</strong>
                                    {{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d F Y') }}</p>
                                <p><strong>Tanggal Diterima:</strong>
                                    {{ \Carbon\Carbon::parse($surat->tanggal_masuk)->format('d F Y') }}</p>
                                <p><strong>No. Agenda:</strong> {{ $surat->no_agenda ?? '-' }}</p>
                                <p><strong>Perihal:</strong> {{ $surat->perihal }}</p>
                                <p><strong>Sifat:</strong> {{ $surat->sifat }}</p>
                                <p><a href="#previewSurat" style="transition: color 0.3s ease;"><strong> Lihat Surat <i
                                                class="bi bi-eye-fill"></i></strong></a></p>
                            </div>

                            {{-- === DITUJUKAN KEPADA (KANAN) === --}}
                            <div class="col-md-6">
                                <label><strong>Diteruskan Kepada:</strong></label>
                                @php
                                    $bidangs = [
                                        'Sekretaris',
                                        'KABID AKUNTANSI',
                                        'KABID PENGANGGARAN',
                                        'KABID BMD',
                                        'KABID PEMBENDAHARAAN',
                                    ];
                                @endphp
                                <div class="ml-4">
                                    @foreach ($bidangs as $bidang)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="kepada_bidang[]"
                                                value="{{ $bidang }}" id="{{ $bidang }}">
                                            <label class="form-check-label"
                                                for="{{ $bidang }}">{{ $bidang }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <hr>

                        {{-- === TINDAKAN === --}}
                        <div class="form-group mt-3">
                            <label><strong>Tindakan:</strong></label>
                            @php
                                $tindakans = [
                                    'Laksanakan Sesuai Ketentuan',
                                    'Buat Laporan',
                                    'Bicarakan / Koordinasikan dengan Saya',
                                    'Pelajari / Proses Sesuai Ketentuan',
                                    'Monitor / Ikuti Perkembangan',
                                    'Koordinasikan dengan yang Terkait',
                                    'Buatkan Telaahan / Tanggapan / ND',
                                    'Harap Hadir & Laporkan',
                                    'Conform & UMP',
                                    'Konsep Jawaban',
                                    'File Simpan',
                                ];
                            @endphp

                            <div class="row ml-2">
                                @foreach ($tindakans as $index => $tindakan)
                                    <div class="col-md-4 mb-1"> {{-- kasih mb-2 biar lebih rapat --}}
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="tindakan[]"
                                                value="{{ $tindakan }}" id="tindakan_{{ $index }}">
                                            <label class="form-check-label" for="tindakan_{{ $index }}">
                                                {{ $tindakan }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach

                                {{-- Lain-lain di kolom terakhir --}}
                                <div class="col-md-4 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="tindakan_lain_checkbox">
                                        <label class="form-check-label" for="tindakan_lain_checkbox">Lain-lain</label>
                                    </div>
                                    <div id="lainnya_wrapper" class="mt-1" style="display: none;">
                                        <input type="text" name="tindakan[]" class="form-control form-control-sm"
                                            placeholder="Tulis tindakan lainnya...">
                                    </div>
                                </div>
                            </div>
                        </div>



                        {{-- === CATATAN / ISI DISPOSISI === --}}
                        <div class="form-group mt-3">
                            <label for="isi_disposisi"><strong>Isi Disposisi:</strong></label>
                            <textarea name="isi_disposisi" id="isi_disposisi" class="form-control" rows="3" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-success mt-2">
                            <i class="bi bi-send"></i> Kirim Disposisi
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- === TAMPILAN SURAT === --}}
        <div id="previewSurat" class="col-12 mt-4">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-dark text-white">
                    <strong>Preview Surat</strong>
                </div>
                <div class="card-body p-2"
                    style="background: linear-gradient(135deg, #7A85C1, #4e5b94); border-radius: 10px;">
                    <embed src="{{ asset('storage/' . $surat->file_surat) }}" type="application/pdf" width="100%"
                        height="600px" style="border-radius: 10px; box-shadow: 0px 0px 15px rgba(0,0,0,0.3);" />
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxLain = document.getElementById('tindakan_lain_checkbox');
            const inputLainWrapper = document.getElementById('lainnya_wrapper');

            checkboxLain.addEventListener('change', function() {
                if (this.checked) {
                    inputLainWrapper.style.display = 'block';
                } else {
                    inputLainWrapper.style.display = 'none';
                    inputLainWrapper.querySelector('input').value = '';
                }
            });
        });
    </script>
@endpush
