@extends('asset.template')

@section('content')
<div class="col-lg-10 mx-auto">
    <div class="card">
        <div class="card-header bg-success text-white">
            <strong>Tindak Lanjut - Surat Balasan</strong>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('asset.tindaklanjut.store', $disposisi->id) }}">
                @csrf

                {{-- Header Surat --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nomor_surat">Nomor Surat</label>
                            <input type="text" name="nomor_surat" id="nomor_surat" class="form-control" placeholder="Contoh: 400.14.5.4/xxx/BKAD/VIII/2025" required>
                        </div>
                        <div class="form-group">
                            <label for="sifat">Sifat</label>
                            <input type="text" name="sifat" id="sifat" class="form-control" placeholder="Contoh: Penting" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lampiran">Lampiran</label>
                            <input type="text" name="lampiran" id="lampiran" class="form-control" placeholder="Contoh: -" required>
                        </div>
                        <div class="form-group">
                            <label for="hal">Hal</label>
                            <input type="text" name="hal" id="hal" class="form-control" placeholder="Contoh: Balasan Permohonan PKL" required>
                        </div>
                    </div>
                </div>

                {{-- Isi Balasan --}}
                <div class="form-group mt-3">
                    <label for="isi_balasan">Isi Surat Balasan</label>
                    <textarea name="isi_balasan" id="isi_balasan" rows="8" class="form-control" required placeholder="Ketik isi surat di sini..."></textarea>
                </div>

                <button type="submit" class="btn btn-primary mt-4">
                    <i class="ti-file"></i> Generate Surat PDF
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
