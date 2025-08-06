@extends('admin.template')
@section('content')
    <div class="col-lg-10 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="card-title">Data Surat Masuk</h4>
                        <p class="card-description">List seluruh surat yang masuk</p>
                    </div>
                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('admin.input_surat') }}" class="btn btn-primary btn-sm">
                            <i class="ti-plus"></i> Tambah Surat
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="suratTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis</th>
                                <th>No Surat</th>
                                <th>Tgl Surat</th>
                                <th>Tgl Masuk</th>
                                <th>No Agenda</th>
                                <th>Asal</th>
                                <th>Perihal</th>
                                <th>Sifat</th>
                                <th>Disposisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($surats as $index => $surat)
                                <tr class="clickable-row" data-href="{{ route('admin.suratmasuk.detail', $surat->id) }}" style="cursor: pointer;" title="Klik untuk melihat ringkasannya!">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $surat->jenis_surat }}</td>
                                    <td>{{ $surat->no_surat }}</td>
                                    <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($surat->tanggal_masuk)->format('d M Y') }}</td>
                                    <td>{{ $surat->no_agenda ?? '-' }}</td>
                                    <td>{{ $surat->asal_surat }}</td>
                                    <td style="white-space: normal; word-wrap: break-word; max-width: 200px;">
                                        {{ $surat->perihal }}
                                    </td>
                                    <td>{{ $surat->sifat ?? '-' }}</td>
                                    <td>
                                        @if ($surat->status_disposisi == 'Belum')
                                            <label class="badge badge-warning">Belum</label>
                                        @elseif($surat->status_disposisi == 'Didisposisikan')
                                            <label class="badge badge-info">Didisposisikan</label>
                                        @else
                                            <label class="badge badge-success">Selesai</label>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection


