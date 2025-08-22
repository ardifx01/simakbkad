@extends('admin.template1')
@section('content')
    <div class="col-10 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Surat Masuk</h4>
                <p class="card-description">Lengkapi informasi pada surat masuk</p>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorAlert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif




                <form id="form-surat" method="POST" action="{{ route('admin.suratmasuk.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        {{-- Kolom Kiri --}}
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="no_surat">No. Surat</label>
                                <input type="text" name="no_surat" class="form-control" value="{{ old('no_surat') }}">
                            </div>

                            <div class="form-group">
                                <label for="asal_surat">Instansi Pengirim</label>
                                <input type="text" name="asal_surat" class="form-control"
                                    value="{{ old('asal_surat') }}">
                            </div>

                            <div class="form-group">
                                <label for="perihal">Perihal Surat</label>
                                <input type="text" name="perihal" class="form-control" value="{{ old('perihal') }}">
                            </div>

                            {{-- Jenis Surat --}}
                            <div class="form-group">
                                <label for="jenis_surat">Jenis Surat</label>
                                <select id="jenis_surat" name="jenis_surat">
                                    <option value="">Cari...</option>
                                    <option>Piagam</option>
                                    <option>Notula</option>
                                    <option>Laporan</option>
                                    <option>Intruksi</option>
                                    <option>Radiogram</option>
                                    <option>Sertifikat</option>
                                    <option>Pengumuman</option>
                                    <option>Surat Izin</option>
                                    <option>Surat Kuasa</option>
                                    <option>Rekomendasi</option>
                                    <option>Berita Acara</option>
                                    <option>Surat Edaran</option>
                                    <option>Telaahan Staf</option>
                                    <option>Berita Daerah</option>
                                    <option>Surat Undangan</option>
                                    <option>Surat Pengantar</option>
                                    <option>Lembaran Daerah</option>
                                    <option>Surat Panggilan</option>
                                    <option>Surat Perjanjian</option>
                                    <option>Surat Keterangan</option>
                                    <option>Surat Pernyataan Melaksanakan Tugas</option>
                                    <option>Surat Tanda Tamat Pendidikan & Pelatihan</option>
                                </select>
                            </div>
                            {{-- Upload File --}}
                            <div class="form-group">
                                <label for="file_surat">Upload File</label>
                                <input type="file" name="file_surat" class="form-control">
                                {{-- <small class="form-text text-danger">* semua file type diizinkan</small> --}}
                            </div>
                        </div>

                        {{-- Kolom Kanan --}}
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="tanggal_surat">Tgl. Surat</label>
                                <input type="date" name="tanggal_surat" class="form-control"
                                    value="{{ old('tanggal_surat') }}">
                            </div>

                            <div class="form-group">
                                <label for="tanggal_masuk">Diterima Tgl.</label>
                                <input type="date" name="tanggal_masuk" class="form-control"
                                    value="{{ old('tanggal_masuk') }}">
                            </div>

                            <div class="form-group">
                                <label for="no_agenda">No. Agenda</label>
                                <input type="text" name="no_agenda" class="form-control" value="{{ old('no_agenda') }}">
                            </div>

                            <div class="form-group">
                                <label for="sifat">Sifat</label>
                                <select name="sifat" class="form-control">
                                    <option value="">-- Pilih Sifat --</option>
                                    <option value="Biasa">Biasa</option>
                                    <option value="Segera">Segera</option>
                                    <option value="Rahasia">Rahasia</option>
                                </select>
                            </div>


                        </div>
                    </div>
                    {{-- Tombol Aksi --}}
                    <div class="d-flex justify-content">
                        {{-- <a href="{{ route('admin.dataSuratMasuk') }}" class="btn btn-danger mr-2">Tutup</a> --}}
                        <button type="submit" class="btn btn-primary"> <i class="ti-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $("#errorAlert").alert('close');
            }, 10000);
        });
    </script>
@endpush

