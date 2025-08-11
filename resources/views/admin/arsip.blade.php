@extends('admin.template')

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
                            @foreach ($arsips as $index => $arsip)
                                <tr class="clickable-row" data-href="{{ optional($arsip->surat)->file_surat }}"
                                    style="cursor: pointer;">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ optional($arsip->surat)->no_agenda }}</td>
                                    <td>{{ optional($arsip->surat)->no_surat }}</td>
                                    <td>{{ optional($arsip->surat)->tanggal_masuk }}</td>
                                    <td>{{ optional($arsip->surat)->asal_surat }}</td>
                                    <td>{{ optional($arsip->surat)->perihal }}</td>
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
                row.addEventListener("click", function() {
                    window.open(this.dataset.href, "_blank"); // buka di tab baru
                });
            });
        });
    </script>
@endpush
