@extends('admin.template1')

@section('content')
    <div class="col-lg-10 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="card-title">Data Pengguna</h4>
                        <p class="card-description">List seluruh pengguna yang terdaftar</p>
                    </div>
                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('admin.tambahPengguna') }}" class="btn btn-primary btn-sm">
                            <i class="ti-plus"></i> Tambah Pengguna
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="suratTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Dibuat Pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->email }}</td>
                                    {{-- <td>{{ $user->role ?? '-' }}</td> --}}
                                    <td>{{ $user->role->nama_role ?? '-' }}</td>

                                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</td>
                                    <td>
                                        <form action="{{ route('admin.user.toggleStatus', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin mengubah status pengguna ini?');">
                                            @csrf
                                            @method('PATCH')
                                            @if ($user->is_active)
                                                <button class="btn btn-sm btn-warning">Nonaktifkan</button>
                                            @else
                                                <button class="btn btn-sm btn-success">Aktifkan</button>
                                            @endif
                                        </form>
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
