@extends('admin.template1')

@section('content')
    <div class="col-lg-10 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Arsip Surat</h4>
                <p class="card-description">Semua surat yang masuk akan diarsipkan di sini</p>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title"> </h4>

                    <div class="dropdown">
                        <button style="border: 1px solid #838ac1; border-radius: 20px;" class="btn btn-sm btn-light dropdown-toggle" type="button" id="dropdownMenuFilter"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-filter"></i>
                            @if ($filter == 'harian')
                                Perhari
                            @elseif($filter == 'mingguan')
                                Perminggu
                            @elseif($filter == 'bulanan')
                                Perbulan
                            @elseif($filter == 'tanggal')
                                Pertanggal
                            @else
                                Pilih Filter
                            @endif
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuFilter">
                            <a class="dropdown-item" href="{{ route('admin.suratmasuk.selesai', ['filter' => 'harian']) }}">
                                <i class="bi bi-calendar3"></i> Perhari
                            </a>
                            <a class="dropdown-item"
                                href="{{ route('admin.suratmasuk.selesai', ['filter' => 'mingguan']) }}">
                                <i class="bi bi-calendar-week"></i> Perminggu
                            </a>
                            <a class="dropdown-item"
                                href="{{ route('admin.suratmasuk.selesai', ['filter' => 'bulanan']) }}">
                                <i class="bi bi-calendar-month"></i> Perbulan
                            </a>
                            <!-- Pertanggal buka modal -->
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#filterTanggalModal">
                                <i class="bi bi-calendar-date"></i> Pertanggal
                            </a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="suratTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No. Agenda</th>
                                <th>No Surat</th>
                                <th>Tanggal Masuk</th>
                                <th>Jenis Surat</th>
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
                                    <td>{{ $surat->jenis_surat }}</td>
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
    <div class="modal fade" id="filterTanggalModal" tabindex="-1" aria-labelledby="filterTanggalModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form method="GET" action="{{ route('admin.suratmasuk.selesai') }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filterTanggalModalLabel">Filter Berdasarkan Tanggal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="filter" value="tanggal">
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Terapkan</button>
                    </div>
                </div>
            </form>
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
