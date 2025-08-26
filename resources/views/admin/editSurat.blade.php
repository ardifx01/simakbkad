@extends('admin.template1')
@section('content')
<div class="col-10 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Surat Masuk</h4>
            <p class="card-description">Perbarui informasi surat masuk</p>

            <form method="POST" action="{{ route('admin.suratmasuk.update', $surat->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No. Surat</label>
                            <input type="text" name="no_surat" class="form-control" value="{{ old('no_surat', $surat->no_surat) }}">
                        </div>

                        <div class="form-group">
                            <label>Instansi Pengirim</label>
                            <input type="text" name="asal_surat" class="form-control" value="{{ old('asal_surat', $surat->asal_surat) }}">
                        </div>

                        <div class="form-group">
                            <label>Perihal</label>
                            <input type="text" name="perihal" class="form-control" value="{{ old('perihal', $surat->perihal) }}">
                        </div>

                        <div class="form-group">
                            <label>Upload File (Kosongkan jika tidak diubah)</label>
                            <input type="file" name="file_surat" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            @if($surat->file_surat)
                                <small class="text-success">File lama: {{ $surat->file_surat }}</small>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tgl. Surat</label>
                            <input type="date" name="tanggal_surat" class="form-control" value="{{ old('tanggal_surat', $surat->tanggal_surat) }}">
                        </div>

                        <div class="form-group">
                            <label>Diterima Tgl.</label>
                            <input type="date" name="tanggal_masuk" class="form-control" value="{{ old('tanggal_masuk', $surat->tanggal_masuk) }}">
                        </div>

                        <div class="form-group">
                            <label>Sifat</label>
                            <select name="sifat" class="form-control">
                                <option value="">-- Pilih Sifat --</option>
                                <option value="Biasa" {{ $surat->sifat == 'Biasa' ? 'selected' : '' }}>Biasa</option>
                                <option value="Segera" {{ $surat->sifat == 'Segera' ? 'selected' : '' }}>Segera</option>
                                <option value="Rahasia" {{ $surat->sifat == 'Rahasia' ? 'selected' : '' }}>Rahasia</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Jenis Surat</label>
                            <select name="jenis_surat" class="form-control">
                                <option value="">-- Pilih Jenis --</option>
                                <option value="LS (Langsung)" {{ $surat->jenis_surat == 'LS (Langsung)' ? 'selected' : '' }}>LS (Langsung)</option>
                                <option value="GU (Ganti Uang) / TU (Tambahan Uang)" {{ $surat->jenis_surat == 'GU (Ganti Uang) / TU (Tambahan Uang)' ? 'selected' : '' }}>GU (Ganti Uang) / TU (Tambahan Uang)</option>
                                <option value="Piagam" {{ $surat->jenis_surat == 'Piagam' ? 'selected' : '' }}>Piagam</option>
                                <option value="Notula" {{ $surat->jenis_surat == 'Notula' ? 'selected' : '' }}>Notula</option>
                                <option value="Laporan" {{ $surat->jenis_surat == 'Laporan' ? 'selected' : '' }}>Laporan</option>
                                <option value="Instruksi" {{ $surat->jenis_surat == 'Instruksi' ? 'selected' : '' }}>Instruksi</option>
                                <option value="Radiogram" {{ $surat->jenis_surat == 'Radiogram' ? 'selected' : '' }}>Radiogram</option>
                                {{-- tambahkan sesuai list di tambah surat --}}
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-end bg-light rounded-bottom">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti-save"></i> Update
                    </button>
                    <a href="{{ route('admin.dataSuratMasuk') }}" class="btn btn-secondary">
                        <i class="ti-close"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
