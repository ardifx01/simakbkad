@extends('admin.template1')

@section('content')
    <div class="col-lg-10 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="card-title">Data Disposisi Masuk</h4>
                        <p class="card-description">List seluruh disposisi surat masuk</p>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="suratTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>No Agenda</th>
                                <th>No Surat</th>
                                <th>Perihal</th>
                                <th>Asal</th>
                                <th>Tgl Surat</th>
                                <th>Tgl Disposisi</th>
                                {{-- <th>Dari</th> --}}
                                <th>Tujuan</th>
                                <th>Disposisi Kaban</th>
                                <th>Catatan Sekretaris</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($disposisis as $index => $disposisi)
                                <tr>
                                    {{-- <td>{{ $index + 1 }}</td> --}}
                                    <td>{{ $disposisi->surat->no_agenda }}</td>
                                    <td>{{ $disposisi->surat->no_surat }}</td>
                                    <td style="white-space: normal; word-wrap: break-word; max-width: 200px;">
                                        {{ $disposisi->surat->perihal }}
                                    </td>
                                    <td>{{ $disposisi->surat->asal_surat }}</td>
                                    <td>{{ \Carbon\Carbon::parse($disposisi->surat->tanggal_surat)->format('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($disposisi->tanggal)->format('d M Y') }}</td>
                                    {{-- <td>{{ $disposisi->dari->nama }}</td> --}}
                                    <td>
                                        @foreach (explode(',', $disposisi->kepada_bidang) as $bidang)
                                            <span class="badge badge-outline-primary">{{ $bidang }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $disposisi->isi_disposisi ?? '-' }}</td>
                                    <td>{{ $disposisi->distribusi->catatan_sekretaris ?? '-' }}</td>
                                    {{-- <td>
                                        <a href="{{ route('admin.disposisi.detail', $disposisi->id) }}"
                                            class="btn btn-sm btn-outline-info" title="Lihat Disposisi">
                                            <i class="ti-eye"></i>
                                        </a>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
