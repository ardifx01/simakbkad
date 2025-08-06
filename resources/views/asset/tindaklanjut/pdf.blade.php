<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Surat Balasan</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 12pt;
            line-height: 1.5;
            margin: 40px;
        }

        .kop {
            text-align: center;
            margin-bottom: 20px;
        }

        .kop img {
            width: 100%;
        }

        .info-surat {
            margin-bottom: 20px;
        }

        .info-surat table {
            width: 100%;
        }

        .info-surat td {
            vertical-align: top;
            padding: 3px;
        }

        .isi {
            text-align: justify;
            /* white-space: pre-line; */
        }

        .ttd {
            margin-top: 50px;
            width: 100%;
        }

        .ttd .kanan {
            float: right;
            text-align: center;
            width: 40%;
        }

        .ttd img {
            width: 150px;
        }
    </style>
</head>
<body>

    {{-- Kop Surat --}}
    <div class="kop">
        <img src="{{ public_path('assets/images/kop-surat.png') }}" alt="Kop Surat">
    </div>

    {{-- Info Surat --}}
    <div class="info-surat">
        <table>
            <tr>
                <td width="15%">Nomor</td>
                <td width="2%">:</td>
                <td>{{ $nomor_surat }}</td>
            </tr>
            <tr>
                <td>Sifat</td>
                <td>:</td>
                <td>{{ $sifat }}</td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td>:</td>
                <td>{{ $lampiran }}</td>
            </tr>
            <tr>
                <td>Hal</td>
                <td>:</td>
                <td>{{ $hal }}</td>
            </tr>
        </table>
    </div>

    {{-- Tujuan --}}
    <p>Kepada Yth:</p>
    <p>{{ $disposisi->surat->asal_surat }}</p>
    <p>di tempat</p>

    {{-- Isi Surat --}}
    <div class="isi">
        {!! nl2br(e($isi_balasan)) !!}
    </div>

    {{-- TTD --}}
    <div class="ttd">
        <div class="kanan">
            <p>Sidikalang, {{ \Carbon\Carbon::parse($tanggal_surat)->format('d F Y') }}</p>
            <p><strong>Bidang Asset</strong></p>
            <img src="{{ public_path('assets/images/bkad1.webp') }}" alt="TTD">
            <p><strong>Nama Pejabat</strong></p>
            <p>NIP. 19670807 199703 1 001</p>
        </div>
    </div>

</body>
</html>
