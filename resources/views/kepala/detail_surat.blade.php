@extends('kepala.template')

@section('content')
    <div class="row col-10">
        <div class="col-12 text-center mb-3">
            <h4 class="bg-primary text-white py-2 rounded">Halaman Disposisi dan Detail Surat</h4>
        </div>

        <div id="settings-trigger" title="Kembali ke Data Surat">
            <a href="{{ route('kepala.dataSuratMasuk') }}">
                <i class="ti-arrow-left"></i>
            </a>
        </div>

        {{-- FORM DISPOSISI + DETAIL SURAT --}}
        <div class="col-12">
            <div class="card border-info">
                <div class="card-header bg-info text-white">
                    <strong>Disposisi Surat</strong>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('kepala.suratmasuk.disposisi') }}">
                        @csrf
                        <input type="hidden" name="surat_id" value="{{ $surat->id }}">

                        {{-- === DETAIL SURAT === --}}
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Asal Surat:</strong> {{ $surat->asal_surat }}</p>
                                <p><strong>No. Surat:</strong> {{ $surat->no_surat }}</p>
                                <p><strong>Tanggal Surat:</strong>
                                    {{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d F Y') }}</p>
                                <p><strong>Tanggal Diterima:</strong>
                                    {{ \Carbon\Carbon::parse($surat->tanggal_masuk)->format('d F Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>No. Agenda:</strong> {{ $surat->no_agenda ?? '-' }}</p>
                                <p><strong>Perihal:</strong> {{ $surat->perihal }}</p>
                                <p><strong>Sifat:</strong> {{ $surat->sifat }}</p>
                            </div>
                        </div>

                        <hr>

                        {{-- === TINDAKAN & DITUJUKAN KEPADA (SEJAJAR) === --}}
                        <div class="row">
                            {{-- TINDAKAN --}}
                            <div class="form-group col-md-6">
                                <label><strong>Tindakan:</strong></label>
                                @php
                                    $tindakans = [
                                        'Laksanakan Sesuai Ketentuan',
                                        'Pelajari / Proses Sesuai Ketentuan',
                                        'Buatkan Telaahan / Jawaban',
                                        'Konsep Jawaban',
                                        'Buat Laporan',
                                        'Monitor / Ikuti Perkembangan',
                                        'Bicarakan / Koordinasikan dengan Saya',
                                        'Koordinasikan dengan yang Terkait',
                                    ];
                                @endphp
                                <div class="ml-2">
                                    @foreach ($tindakans as $index => $tindakan)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="tindakan[]"
                                                value="{{ $tindakan }}" id="tindakan_{{ $index }}">
                                            <label class="form-check-label"
                                                for="tindakan_{{ $index }}">{{ $tindakan }}</label>
                                        </div>
                                    @endforeach

                                    {{-- Lain-lain --}}
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="tindakan_lain_checkbox">
                                        <label class="form-check-label" for="tindakan_lain_checkbox">Lain-lain</label>
                                    </div>
                                    <div id="lainnya_wrapper" class="mt-2" style="display: none;">
                                        <input type="text" name="tindakan[]" class="form-control"
                                            placeholder="Tulis tindakan lainnya...">
                                    </div>
                                </div>
                            </div>

                            {{-- DITUJUKAN KEPADA --}}
                            <div class="form-group col-md-6">
                                <label><strong>Diteruskan Kepada:</strong></label>
                                @php
                                    $bidangs = [
                                        'Sekretaris',
                                    ];
                                @endphp
                                <div class="ml-2">
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


                        {{-- === CATATAN / ISI DISPOSISI === --}}
                        <div class="form-group mt-3">
                            <label for="isi_disposisi"><strong>Isi Disposisi:</strong></label>
                            <textarea name="isi_disposisi" id="isi_disposisi" class="form-control" rows="3" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-success mt-2">Kirim Disposisi</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- === TAMPILAN SURAT === --}}
        <div class="col-12 mt-4">
            <div class="card border-info">
                <div class="card-header bg-info text-white">
                    <strong>Tampilan Surat</strong>
                </div>
                <div class="card-body p-2">
                     <embed src="{{ asset('storage/' . $surat->file_surat) }}" type="application/pdf" width="100%"
                            height="500px" />
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
