<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Keputusan</title>
    <style>
        @page {
            size: 21.59cm 33.02cm; /*Ukuaran F4*/
            margin: 1.5cm 2cm 1.5cm 2cm; /* Top, Right, Bottom, Left */
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 10pt;
            line-height: 1.2;
            margin: 0;
            padding: 0;
            text-align: justify;
        }
        .text-center { text-align: center; }
        .bold { font-weight: bold; }
        
        .header-title {
            font-weight: bold;
            font-size: 10.5pt;
            text-align: center;
        }
        .header-spacing {
            margin-bottom: 8px;
        }
        
        .table-layout {
            width: 100%;
            border-collapse: collapse;
        }
        .table-layout td {
            vertical-align: top;
            padding: 2px 0;
        }
        .col-label { width: 100px; }
        .col-colon { width: 15px; text-align: center; }
        .col-content { text-align: justify; }
        
        .list-mengingat {
            margin: 0;
            padding-left: 15px;
        }
        .list-mengingat li {
            text-align: justify;
            margin-bottom: 2px;
        }
        
        .table-pegawai {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2px;
        }
        .table-pegawai td {
            vertical-align: top;
            padding: 1px 0;
        }
        .tp-num { width: 15px; }
        .tp-label { width: 170px; }
        .tp-colon { width: 15px; text-align: center; }
        
        .ttd-wrapper {
            width: 100%;
            margin-top: 15px;
        }
        .ttd-wrapper td {
            padding: 1px 0;
        }
        
        .ttd-footer {
            margin-top: 15px;
            width: 100%;
        }
        .ttd-footer-left {
            width: 100%;
        }
        
        .clearfix { clear: both; }
    </style>
</head>
<body>
    <!-- HEADER -->
    <div class="text-center" style="margin-bottom: 15px;">
        <!-- <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/84/National_emblem_of_Indonesia_Garuda_Pancasila.svg/100px-National_emblem_of_Indonesia_Garuda_Pancasila.svg.png" style="width: 50px; height: auto;" alt="Garuda" onerror="this.style.display='none'"> -->
    </div>
    
    <div class="header-title header-spacing">BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA<br>KABUPATEN KEPULAUAN SELAYAR</div>
    
    <div class="header-title" style="margin-top: 15px;">PETIKAN</div>
    <div class="header-title">KEPUTUSAN KEPALA BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA<br>KABUPATEN KEPULAUAN SELAYAR</div>
    <div class="header-title header-spacing">Nomor : {{ $pengajuan->nomor_pengajuan }}/SK/{{ date('Y') }}</div>
    
    <div class="header-title">TENTANG</div>
    <div class="header-title header-spacing" style="margin-bottom: 15px;">KENAIKAN PANGKAT PEGAWAI NEGERI SIPIL</div>
    
    <div class="header-title" style="margin-bottom: 15px;">KEPALA BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA<br>KABUPATEN KEPULAUAN SELAYAR</div>
    
    <!-- KONSIDERAN -->
    <table class="table-layout">
        <tr>
            <td class="col-label">Menimbang</td>
            <td class="col-colon">:</td>
            <td class="col-content">bahwa Pegawai Negeri Sipil yang namanya tersebut dalam Keputusan ini, memenuhi syarat dan dipandang cakap untuk dinaikkan pangkatnya setingkat lebih tinggi;</td>
        </tr>
        <tr>
            <td class="col-label">Mengingat</td>
            <td class="col-colon">:</td>
            <td class="col-content">
                <ol class="list-mengingat">
                    <li>Undang-undang Nomor 5 Tahun 2014;</li>
                    <li>Peraturan Pemerintah Nomor 11 Tahun 2017;</li>
                    <li>Peraturan Pemerintah Nomor 7 Tahun 1977 jo. Peraturan Pemerintah Nomor 15 Tahun 2019;</li>
                    <li>Keputusan Kepala Badan Kepegawaian Negara Nomor 12 Tahun 2002;</li>
                </ol>
            </td>
        </tr>
        <tr>
            <td class="col-label">Memperhatikan</td>
            <td class="col-colon">:</td>
            <td class="col-content">Pertimbangan teknis Kepala Kantor Regional IV Badan Kepegawaian Negara Nomor ... tanggal ...</td>
        </tr>
    </table>
    
    <div class="text-center bold" style="margin: 15px 0; letter-spacing: 5px;">M E M U T U S K A N</div>
    
    <!-- DIKTUM -->
    <table class="table-layout">
        <tr>
            <td class="col-label">Menetapkan</td>
            <td class="col-colon">:</td>
            <td class="col-content">KEPUTUSAN KEPALA BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA KABUPATEN KEPULAUAN SELAYAR TENTANG KENAIKAN PANGKAT PEGAWAI NEGERI SIPIL.</td>
        </tr>
        <tr>
            <td class="col-label">PERTAMA</td>
            <td class="col-colon">:</td>
            <td class="col-content">
                Pegawai Negeri Sipil, nomor urut : 1
                <table class="table-pegawai">
                    <tr>
                        <td class="tp-num">1.</td>
                        <td class="tp-label">Nama Pegawai</td>
                        <td class="tp-colon">:</td>
                        <td>{{ $pengajuan->pegawai->user->nama }}</td>
                    </tr>
                    <tr>
                        <td class="tp-num">2.</td>
                        <td class="tp-label">Tempat/Tanggal Lahir</td>
                        <td class="tp-colon">:</td>
                        <td>{{ $pengajuan->pegawai->user->tempat_lahir ?? '-' }} / {{ $pengajuan->pegawai->user->tgl_lahir ? date('d-m-Y', strtotime($pengajuan->pegawai->user->tgl_lahir)) : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="tp-num">3.</td>
                        <td class="tp-label">NIP</td>
                        <td class="tp-colon">:</td>
                        <td>{{ $pengajuan->pegawai->user->nip }}</td>
                    </tr>
                    <tr>
                        <td class="tp-num">4.</td>
                        <td class="tp-label">Pendidikan</td>
                        <td class="tp-colon">:</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td class="tp-num">5.</td>
                        <td class="tp-label">Pangkat lama / golongan<br>ruang / TMT</td>
                        <td class="tp-colon">:</td>
                        <td>{{ $pengajuan->pangkat_lama }}</td>
                    </tr>
                    <tr>
                        <td class="tp-num">6.</td>
                        <td class="tp-label">Jabatan</td>
                        <td class="tp-colon">:</td>
                        <td>{{ $pengajuan->pegawai->jabatan->nama_jabatan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="tp-num">7.</td>
                        <td class="tp-label">Unit Kerja</td>
                        <td class="tp-colon">:</td>
                        <td>{{ $pengajuan->pegawai->unit_kerja ?? '-' }}</td>
                    </tr>
                </table>
                <div style="margin-top: 8px; text-align: justify;">
                    Terhitung mulai tanggal {{ $pengajuan->tanggal->format('d F Y') }} dinaikkan pangkatnya menjadi {{ $pengajuan->pangkat_baru }}.
                </div>
            </td>
        </tr>
        <tr>
            <td class="col-label" style="padding-top: 10px;">KEDUA</td>
            <td class="col-colon" style="padding-top: 10px;">:</td>
            <td class="col-content" style="padding-top: 10px;">Apabila dikemudian hari ternyata terdapat kekeliruan dalam keputusan ini, akan diadakan perbaikan dan penghitungan kembali sebagaimana mestinya.</td>
        </tr>
    </table>
    
    <!-- TTD MAIN -->
    <table class="ttd-wrapper">
        <tr>
            <td style="width: 50%;"></td>
            <td style="width: 50%;">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 85px;">Ditetapkan di</td>
                        <td style="width: 10px;">:</td>
                        <td>Benteng</td>
                    </tr>
                    <tr>
                        <td>Pada tanggal</td>
                        <td>:</td>
                        <td>{{ date('d F Y') }}</td>
                    </tr>
                </table>
                <div style="margin-top: 10px; text-align: center;">
                    Kepala Badan Kepegawaian dan Pengembangan<br>Sumber Daya Manusia<br>Kabupaten Kepulauan Selayar
                    <br><br><br><br>
                    <span style="text-decoration: underline; display: inline-block; min-width: 150px;">{{ $kepalaBkd->nama ?? '..................................................' }}</span><br>
                    NIP. {{ $kepalaBkd->nip ?? '........................................' }}
                </div>
            </td>
        </tr>
    </table>
    
    <!-- TTD FOOTER -->
    <div class="ttd-footer">
        <div style="margin-bottom: 10px; text-align: left;">
            Untuk petikan yang sah<br>
            Sesuai dengan aslinya,
        </div>
        
        <table style="width: 100%;">
            <tr>
                <td style="width: 50%; vertical-align: top; text-align: center;">
                    Sekretaris,
                    <br><br><br><br>
                    <span style="text-decoration: underline; display: inline-block; min-width: 150px;">{{ $sekretaris->nama ?? '..................................................' }}</span><br>
                    NIP. {{ $sekretaris->nip ?? '........................................' }}
                </td>
                <td style="width: 50%; vertical-align: top; text-align: center;">
                    Kepala Bidang,
                    <br><br><br><br>
                    <span style="text-decoration: underline; display: inline-block; min-width: 150px;">{{ $kabid->nama ?? '..................................................' }}</span><br>
                    NIP. {{ $kabid->nip ?? '........................................' }}
                </td>
            </tr>
        </table>
    </div>

</body>
</html>
