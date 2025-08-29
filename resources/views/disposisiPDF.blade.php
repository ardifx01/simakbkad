<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Lembar Disposisi</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        .header {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }

        .checkbox-list {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
        }

        .checkbox-item input {
            margin-right: 6px;
        }
    </style>
</head>

<body>

    <div class="header">
        PEMERINTAH KABUPATEN DAIRI <br>
        <strong>BADAN KEUANGAN DAN ASET DAERAH</strong> <br>
        LEMBAR DISPOSISI
    </div>

    <table>
        <tr>
            {{-- Kiri: Detail Surat --}}
            <td width="50%">
                <strong>Surat Dari:</strong> {{ $surat->asal_surat }} <br>
                <strong>Nomor:</strong> {{ $surat->no_surat }} <br>
                <strong>Tanggal Surat:</strong> {{ $surat->tanggal_surat }} <br>
                <strong>No Agenda:</strong> {{ $surat->no_agenda }} <br>
                <strong>Tanggal Masuk:</strong> {{ $surat->tanggal_masuk }} <br>
                <strong>Perihal:</strong> {{ $surat->perihal }}
            </td>

            {{-- Kanan: Distribusi --}}
            <td width="50%">
                <strong>Diteruskan Kepada:</strong>
                <div class="checkbox-list">
                    @php
                        $kepada = $surat->disposisi->pluck('kepada_bidang')->implode(', ');
                        $opsiBidang = [
                            'Sekretaris',
                            'KABID AKUNTANSI',
                            'KABID ANGGARAN',
                            'KABID BMD',
                            'KABID PEMBENDAHARAAN',
                        ];
                    @endphp

                    @foreach ($opsiBidang as $bidang)
                        <label class="checkbox-item">
                            <input type="checkbox" {{ str_contains($kepada, $bidang) ? 'checked' : '' }}>
                            {{ $bidang }}
                        </label>
                    @endforeach
                </div>
            </td>
        </tr>
    </table>

    {{-- Bagian Tindakan --}}
    <div style="border:1px solid #000; padding:6px; margin-bottom:10px;">
        <strong>Tindakan:</strong>
        <div class="checkbox-list">
            @php
                $tindakan = $surat->disposisi->pluck('tindakan')->implode(', ');
                $opsiTindakan = [
                    'Laksanakan Sesuai Petunjuk',
                    'Buat Laporan',
                    'Bicarakan / Koordinasikan dengan Saya',
                    'Pelajari / Proses Sesuai Ketentuan',
                    'Monitor / Ikuti Perkembangan',
                    'Koordinasikan dengan yang Terkait',
                    'Buatkan Telaahan / Tanggapan / ND',
                    'Harap Hadir & Laporkan',
                    'Conform & UMP',
                    'Konsep Jawaban',
                    'File Simpan',
                ];
            @endphp

            @foreach ($opsiTindakan as $opsi)
                <label class="checkbox-item">
                    <input type="checkbox" {{ str_contains($tindakan, $opsi) ? 'checked' : '' }}> {{ $opsi }}
                </label>
            @endforeach
        </div>
    </div>

    {{-- Isi Disposisi --}}
    <div style="border:1px solid #000; padding:6px; margin-bottom:10px;">
        <strong>Isi Disposisi:</strong>
        <div style="min-height:50px;">
            {{ $surat->disposisi->first()->isi_disposisi ?? '-' }}
        </div>
    </div>

    {{-- Catatan Sekretaris --}}
    <div style="border:1px solid #000; padding:6px;">
        <strong>Catatan Sekretaris:</strong>
        <div style="min-height:50px;">
            @php
                $catatanSekretaris = $surat->distribusi->pluck('catatan_sekretaris')->filter()->implode(', ');
            @endphp
            {{ $catatanSekretaris ?: '-' }}
        </div>
    </div>

</body>

</html>
