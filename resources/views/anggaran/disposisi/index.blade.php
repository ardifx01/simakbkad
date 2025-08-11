@extends('anggaran.template')

@section('content')
<div class="col-lg-10 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Disposisi Masuk untuk Bidang Anggaran</h4>
            <p class="card-description">List disposisi yang ditujukan ke bidang Anggaran</p>

            <div class="table-responsive">
                <table id="suratTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Agenda</th>
                            <th>No Surat</th>
                            <th>Perihal</th>
                            <th>Dari</th>
                            <th>Tanggal Disposisi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($disposisis as $index => $disposisi)
                            <tr class="clickable-row" 
                                data-href="{{ route('anggaran.disposisi.detail', $disposisi->id) }}"
                                style="cursor: pointer;">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $disposisi->surat->no_agenda }}</td>
                                <td>{{ $disposisi->surat->no_surat }}</td>
                                <td>{{ $disposisi->surat->perihal }}</td>
                                <td>{{ $disposisi->surat->asal_surat }}</td>
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

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const rows = document.querySelectorAll(".clickable-row");
        rows.forEach(row => {
            row.addEventListener("click", function() {
                window.location.href = this.dataset.href;
            });
        });
    });
</script>
@endpush
