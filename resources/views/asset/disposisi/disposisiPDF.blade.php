<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Lembar Disposisi</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h2>Lembar Disposisi</h2>

    <p><strong>No Surat:</strong> {{ $surat->no_surat }}</p>
    <p><strong>Perihal:</strong> {{ $surat->perihal }}</p>
    <p><strong>Asal Surat:</strong> {{ $surat->asal_surat }}</p>
    <p><strong>Tanggal Masuk:</strong> {{ $surat->tanggal_masuk }}</p>

    <h3>Riwayat Disposisi</h3>
    @if ($surat->disposisi->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>Dari</th>
                    <th>Kepada Bidang</th>
                    <th>Isi Disposisi Kepala Badan</th>
                    <th>Isi Catatan Sekretaris</th>
                    <th>Tindakan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($surat->disposisi as $disposisi)
                    <tr>
                        <td>{{ $disposisi->dari->nama ?? '-' }}</td>
                        <td>{{ $disposisi->kepada_bidang ?? '-' }}</td>
                        <td>{{ $disposisi->isi_disposisi ?? '-' }}</td>
                        {{-- ambil catatan sekretaris dari tabel distribusi --}}
                        <td>
                            @php
                                $catatanSekretaris = $surat->distribusi->pluck('catatan_sekretaris')->filter()->implode(', ');
                            @endphp
                            {{ $catatanSekretaris ?: '-' }}
                        </td>
                        <td>{{ $disposisi->tindakan ?? '-' }}</td>
                        <td>{{ $disposisi->tanggal ?? '-' }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    @else
        <p><em>Belum ada disposisi</em></p>
    @endif

</body>

</html>
