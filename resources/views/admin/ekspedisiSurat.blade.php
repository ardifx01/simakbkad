@extends('admin.template1')
@section('content')
    <div class="col-lg-10 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="card-title">Data Ekspedisi Surat Masuk</h4>
                        <p class="card-description">List ekspedisi surat yang telah tercatat</p>
                    </div>
                    {{-- Contoh tombol tambah ekspedisi, sesuaikan jika perlu --}}
                </div>

                <div class="table-responsive">
                    <table id="suratTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Ekspedisi</th>
                                <th>Nomor Surat</th>
                                <th>Tanggal</th>
                                <th>Asal Surat</th>
                                <th>Perihal</th>
                                <th>Penerima Surat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ekspedisis as $index => $ekspedisi)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $ekspedisi->no ?? '-' }}</td>
                                    <td>{{ $ekspedisi->nomor_surat }}</td>
                                    <td>{{ \Carbon\Carbon::parse($ekspedisi->tanggal)->format('d M Y') }}</td>
                                    <td>{{ $ekspedisi->sipengirim }}</td>
                                    <td>{{ $ekspedisi->perihal }}</td>
                                    <td><b>{{ $ekspedisi->sipenerima }}</b></td>
                                </tr>
                            @empty
                                {{-- <tr>
                                    <td colspan="5" class="text-center">Data ekspedisi kosong.</td>
                                </tr> --}}
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
