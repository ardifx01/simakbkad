@extends('pembendaharaan.template')

@section('content')
<div class="col-lg-10 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Disposisi Masuk untuk Bidang Asset</h4>
            <p class="card-description">List disposisi yang ditujukan ke bidang Asset</p>

            <div class="table-responsive">
                <table id="suratTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Surat</th>
                            <th>Perihal</th>
                            <th>Dari</th>
                            <th>Tanggal Disposisi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($disposisis as $index => $disposisi)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $disposisi->surat->no_surat }}</td>
                                <td>{{ $disposisi->surat->perihal }}</td>
                                <td>{{ $disposisi->dari->nama }}</td>
                                <td>{{ \Carbon\Carbon::parse($disposisi->tanggal)->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
