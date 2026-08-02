<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pengajuan Kenaikan Pangkat</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 1.5cm 2cm 1.5cm 2cm;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            color: #222;
            margin: 0;
        }
        .header-kop {
            text-align: center;
            margin-bottom: 10px;
            padding-bottom: 8px;
            border-bottom: 3px double #333;
        }
        .header-kop .instansi {
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.3;
        }
        .header-kop .sub-instansi {
            font-size: 12pt;
            font-weight: bold;
        }
        .header-kop .alamat {
            font-size: 9pt;
            margin-top: 2px;
        }
        .judul {
            text-align: center;
            margin: 12px 0 5px 0;
        }
        .judul h2 {
            font-size: 13pt;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0 0 4px 0;
            text-decoration: underline;
        }
        .info-filter {
            margin: 8px 0;
            font-size: 10pt;
        }
        .info-filter span {
            margin-right: 25px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        thead th {
            background-color: #12A150;
            color: white;
            border: 1px solid #0B5C33;
            padding: 6px 8px;
            text-align: center;
            font-weight: bold;
            font-size: 10pt;
            text-transform: uppercase;
        }
        tbody td {
            border: 1px solid #ccc;
            padding: 5px 8px;
            font-size: 10pt;
            vertical-align: middle;
        }
        tbody tr:nth-child(even) td {
            background-color: #EAF7EF;
        }
        tfoot th {
            background-color: #EAF7EF;
            color: #0B5C33;
            border: 1px solid #0B5C33;
            padding: 5px 8px;
            font-weight: bold;
            font-size: 10pt;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 9pt;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="header-kop">
        <div class="instansi">Badan Kepegawaian dan Pengembangan Sumber Daya Manusia</div>
        <div class="sub-instansi">Kabupaten Kepulauan Selayar</div>
        <div class="alamat">Jl. Jend. Ahmad Yani, Benteng Selatan, Kec. Benteng, Kab. Kepulauan Selayar, Sulawesi Selatan</div>
    </div>

    <div class="judul">
        <h2>Laporan Pengajuan Kenaikan Pangkat</h2>
    </div>

    <div class="info-filter">
        @if($params['bulan'] ?? false)
            <span>Bulan: <strong>{{ \Carbon\Carbon::create()->month($params['bulan'])->format('F') }}</strong></span>
        @endif
        @if($params['tahun'] ?? false)
            <span>Tahun: <strong>{{ $params['tahun'] }}</strong></span>
        @endif
        @if($params['status'] ?? false)
            <span>Status: <strong>{{ ucfirst($params['status']) }}</strong></span>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th>Nomor Pengajuan</th>
                <th>Nama Pegawai</th>
                <th>NIP</th>
                <th>Tanggal</th>
                <th>Pangkat Lama</th>
                <th>Pangkat Baru</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengajuans as $p)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $p->nomor_pengajuan }}</td>
                <td>{{ $p->pegawai->user->nama }}</td>
                <td>{{ $p->pegawai->user->nip }}</td>
                <td class="text-center">{{ $p->tanggal->format('d/m/Y') }}</td>
                <td>{{ $p->pangkat_lama }}</td>
                <td>{{ $p->pangkat_baru }}</td>
                <td class="text-center">{{ ucfirst(str_replace('_', ' ', $p->status)) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="7" class="text-right">Total Pengajuan :</th>
                <th class="text-center">{{ $pengajuans->count() }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>
