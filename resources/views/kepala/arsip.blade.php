@extends('kepala.template')

@section('content')
    <div class="col-lg-10 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Arsip Surat</h4>
                <p class="card-description">Semua surat yang masuk akan diarsipkan di sini</p>

                <div class="table-responsive">
                    <table id="suratTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No. Agenda</th>
                                <th>No Surat</th>
                                <th>Tanggal Masuk</th>
                                <th>Asal Surat</th>
                                <th>Perihal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($surats as $index => $surat)
                                <tr class="clickable-row"
                                    data-href="{{ $surat->file_surat ? asset('storage/' . $surat->file_surat) : '#' }}"
                                    style="cursor: pointer;">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $surat->no_agenda }}</td>
                                    <td>{{ $surat->no_surat }}</td>
                                    <td>{{ $surat->tanggal_masuk }}</td>
                                    <td>{{ $surat->asal_surat }}</td>
                                    <td>{{ $surat->perihal }}</td>
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
        document.querySelectorAll(".clickable-row").forEach(row => {
            row.addEventListener("click", function(e) {
                e.preventDefault();
                e.stopPropagation();
                if (this.dataset.href && this.dataset.href !== '#') {
                    let link = document.createElement('a');
                    link.href = this.dataset.href;
                    link.target = '_blank'; // paksa tab baru
                    link.rel = 'noopener noreferrer';
                    link.click();
                } else {
                    alert("⚠️ File surat tidak tersedia!");
                }
            });
        });
    });
</script>
@endpush


