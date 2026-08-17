<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Pengguna - SIPAK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0F9D58;
            --primary-dark: #0A5C36;
            --primary-light: #E8F5E9;
            --text-main: #1E293B;
            --text-muted: #64748B;
            --bg-body: #F8FAFC;
            --surface: #FFFFFF;
            --border: #E2E8F0;
            --radius-md: 12px;
            --radius-lg: 20px;
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { margin: 0; background-color: var(--bg-body); color: var(--text-main); font-family: 'Plus Jakarta Sans', system-ui, sans-serif; font-size: 1rem; line-height: 1.6; }
        a { text-decoration: none; transition: var(--transition); }

        .navbar-pro {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            padding: 16px 0;
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(226,232,240,0.6);
            transition: var(--transition);
        }
        .navbar-pro.scrolled { padding: 12px 0; background: rgba(255,255,255,0.95); box-shadow: var(--shadow-sm); }
        .nav-container { max-width: 1200px; margin: 0 auto; padding: 0 24px; display: flex; align-items: center; justify-content: space-between; }
        .brand-mark { display: flex; align-items: center; gap: 10px; }
        .brand-mark .icon-badge { width: 40px; height: 40px; border-radius: 10px; background: var(--primary-light); display: flex; align-items: center; justify-content: center; }
        .brand-mark .icon-badge i { color: var(--primary-dark); font-size: 17px; }
        .brand-mark span { font-weight: 700; font-size: 1.25rem; color: var(--text-main); letter-spacing: -0.5px; }
        .nav-actions { display: flex; align-items: center; gap: 24px; }
        .nav-link-custom { color: var(--text-muted); font-weight: 600; font-size: 0.9rem; }
        .nav-link-custom:hover { color: var(--primary); }
        .btn-login { color: var(--primary-dark); font-weight: 700; font-size: 0.9rem; padding: 8px 16px; }
        .btn-register { background: var(--primary); color: white !important; font-weight: 700; font-size: 0.9rem; padding: 10px 24px; border-radius: 100px; box-shadow: 0 4px 14px rgba(15,157,88,0.25); }
        .btn-register:hover { background: var(--primary-dark); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(15,157,88,0.35); }

        .page-hero {
            padding: 140px 0 60px;
            background: linear-gradient(135deg, #ffffff 0%, var(--primary-light) 100%);
            border-bottom: 1px solid var(--border);
        }
        .breadcrumb-top { font-size: 0.85rem; color: var(--text-muted); margin-bottom: 16px; }
        .breadcrumb-top a { color: var(--primary); font-weight: 600; }
        .breadcrumb-top span { margin: 0 8px; }
        .page-hero h1 { font-size: 2rem; font-weight: 800; color: var(--text-main); margin: 0 0 12px; letter-spacing: -0.5px; }
        .page-hero p { color: var(--text-muted); font-size: 1.05rem; margin: 0; max-width: 560px; }

        .page-content { padding: 64px 0 80px; }
        .guide-tabs { display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 32px; }
        .guide-tab {
            display: flex; align-items: center; gap: 10px;
            padding: 12px 24px;
            border: 1px solid var(--border);
            border-radius: 100px;
            background: var(--surface);
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-muted);
            cursor: pointer;
            transition: var(--transition);
        }
        .guide-tab i { font-size: 0.95rem; }
        .guide-tab:hover { border-color: rgba(15,157,88,0.4); color: var(--primary); }
        .guide-tab.active { background: var(--primary); border-color: var(--primary); color: white; box-shadow: 0 6px 16px rgba(15,157,88,0.25); }

        .guide-panel { display: none; }
        .guide-panel.active { display: block; animation: fadeIn 0.4s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }

        .guide-steps { max-width: 820px; }
        .guide-step {
            display: flex; gap: 20px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 24px;
            margin-bottom: 16px;
            transition: var(--transition);
        }
        .guide-step:hover { border-color: rgba(15,157,88,0.3); box-shadow: var(--shadow-md); }
        .step-num {
            flex-shrink: 0;
            width: 48px; height: 48px;
            border-radius: 14px;
            background: var(--primary-light);
            color: var(--primary-dark);
            font-weight: 800;
            font-size: 1.1rem;
            display: flex; align-items: center; justify-content: center;
        }
        .step-body h4 { font-size: 1rem; font-weight: 700; margin: 0 0 8px; color: var(--text-main); }
        .step-body p { margin: 0; color: var(--text-muted); font-size: 0.92rem; line-height: 1.8; }
        .step-body ul { margin: 8px 0 0; padding-left: 18px; color: var(--text-muted); font-size: 0.92rem; line-height: 1.9; }
        .step-body .text-highlight { color: var(--primary); font-weight: 600; }

        .guide-callout {
            background: var(--primary-light);
            border: 1px solid rgba(15,157,88,0.2);
            border-radius: var(--radius-md);
            padding: 20px 24px;
            margin-top: 24px;
            display: flex; gap: 14px; align-items: flex-start;
            font-size: 0.92rem;
            color: var(--primary-dark);
            line-height: 1.7;
        }
        .guide-callout i { flex-shrink: 0; margin-top: 3px; }

        .footer-pro { background: var(--surface); border-top: 1px solid var(--border); padding: 80px 0 32px; margin-top: 100px; font-size: 0.9rem; }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 48px; margin-bottom: 64px; }
        .footer-brand p { color: var(--text-muted); margin-top: 16px; max-width: 280px; line-height: 1.7; }
        .footer-col h5 { font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: var(--text-main); margin-bottom: 24px; }
        .footer-links { list-style: none; padding: 0; margin: 0; }
        .footer-links li { margin-bottom: 12px; }
        .footer-links a { color: var(--text-muted); font-weight: 500; display: inline-block; }
        .footer-links a:hover { color: var(--primary); transform: translateX(4px); }
        .footer-contact-list { list-style: none; padding: 0; margin: 0; }
        .footer-contact-list li { display: flex; align-items: flex-start; gap: 8px; margin-bottom: 12px; }
        .footer-contact-icon { color: var(--primary) !important; flex-shrink: 0; margin-top: 3px; }
        .footer-socials { display: flex; gap: 12px; margin-top: 24px; }
        .social-icon { width: 36px; height: 36px; background: var(--bg-body); border: 1px solid var(--border); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: var(--text-muted); transition: var(--transition); }
        .social-icon:hover { background: var(--primary); border-color: var(--primary); color: white; }
        .footer-bottom { padding-top: 32px; border-top: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; font-size: 0.8rem; color: var(--text-muted); }

        @media (max-width: 992px) { .footer-grid { grid-template-columns: 1fr 1fr; gap: 32px; } }
        @media (max-width: 768px) {
            .nav-actions .nav-link-custom { display: none; }
            .footer-grid { grid-template-columns: 1fr; gap: 40px; }
            .footer-bottom { flex-direction: column; gap: 16px; text-align: center; }
            .page-hero { padding: 120px 0 40px; }
            .page-hero h1 { font-size: 1.5rem; }
            .guide-step { flex-direction: column; gap: 12px; }
        }
    </style>
</head>
<body>
    <nav class="navbar-pro" id="mainNav">
        <div class="nav-container">
            <a href="{{ url('/') }}" class="brand-mark text-decoration-none">
                <div class="icon-badge"><i class="fas fa-award"></i></div>
                <span>SIPAK</span>
            </a>
            <div class="nav-actions">
                <a href="{{ url('/#alur') }}" class="nav-link-custom">Alur Pengajuan</a>
                <a href="{{ url('/#layanan') }}" class="nav-link-custom">Layanan</a>
                <a href="{{ route('login') }}" class="btn-login">Masuk</a>
                <a href="{{ route('register') }}" class="btn-register">Daftar</a>
            </div>
        </div>
    </nav>

    <section class="page-hero">
        <div class="container">
            <div class="breadcrumb-top">
                <a href="{{ url('/') }}">Beranda</a> <span>/</span> Panduan Pengguna
            </div>
            <h1>Panduan Pengguna</h1>
            <p>Panduan langkah demi langkah penggunaan SIPAK, disesuaikan dengan peran Anda.</p>
        </div>
    </section>

    <section class="page-content">
        <div class="container">
            <div class="guide-tabs">
                <div class="guide-tab active" onclick="showGuide(this, 'pegawai')">
                    <i class="fas fa-user-tie"></i> Pegawai
                </div>
                <div class="guide-tab" onclick="showGuide(this, 'admin')">
                    <i class="fas fa-user-shield"></i> Admin BKD
                </div>
                <div class="guide-tab" onclick="showGuide(this, 'pimpinan')">
                    <i class="fas fa-user-tag"></i> Pimpinan
                </div>
            </div>

            <!-- ===== PANDUAN PEGAWAI ===== -->
            <div class="guide-panel active" id="panel-pegawai">
                <div class="guide-steps">
                    <div class="guide-step">
                        <div class="step-num">1</div>
                        <div class="step-body">
                            <h4>Daftar Akun</h4>
                            <p>Buka halaman <span class="text-highlight">Daftar</span>, lalu isi formulir registrasi meliputi <strong>NIP</strong>, <strong>nama lengkap</strong>, <strong>alamat email aktif</strong>, dan <strong>kata sandi</strong>. Setelah berhasil, masuk dengan akun yang baru dibuat.</p>
                        </div>
                    </div>
                    <div class="guide-step">
                        <div class="step-num">2</div>
                        <div class="step-body">
                            <h4>Lengkapi Profil</h4>
                            <p>Dari menu <span class="text-highlight">Profil</span> di dashboard, lengkapi data diri dan data kepegawaian seperti tempat/tanggal lahir, jabatan, pangkat, dan unit kerja. Profil yang lengkap diperlukan agar pengajuan dapat diproses.</p>
                        </div>
                    </div>
                    <div class="guide-step">
                        <div class="step-num">3</div>
                        <div class="step-body">
                            <h4>Buat Pengajuan Kenaikan Pangkat</h4>
                            <p>Klik menu <span class="text-highlight">Pengajuan Baru</span>, lalu isi detail pengajuan:</p>
                            <ul>
                                <li>Tanggal kenaikan pangkat (TMT).</li>
                                <li>Pangkat lama dan pangkat baru.</li>
                                <li>Jenis kenaikan pangkat.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="guide-step">
                        <div class="step-num">4</div>
                        <div class="step-body">
                            <h4>Unggah Dokumen Pendukung</h4>
                            <p>Unggah seluruh dokumen persyaratan dengan format <strong>PDF/JPG/PNG</strong> (maks. 5 MB per berkas):</p>
                            <ul>
                                <li>SK Pangkat Terakhir</li>
                                <li>SKP (Penilaian Prestasi Kerja)</li>
                                <li>Ijazah</li>
                                <li>Dokumen Pendukung lainnya</li>
                            </ul>
                        </div>
                    </div>
                    <div class="guide-step">
                        <div class="step-num">5</div>
                        <div class="step-body">
                            <h4>Pantau Status Pengajuan</h4>
                            <p>Pantau progres pengajuan melalui menu <span class="text-highlight">Riwayat</span>. Anda akan menerima notifikasi pada setiap perubahan status, mulai dari menunggu verifikasi hingga disetujui.</p>
                        </div>
                    </div>
                    <div class="guide-step">
                        <div class="step-num">6</div>
                        <div class="step-body">
                            <h4>Unduh SK</h4>
                            <p>Setelah pengajuan <strong>disetujui</strong>, klik tombol <span class="text-highlight">Unduh SK</span> pada pengajuan di menu Riwayat. SK akan diunduh dalam format PDF resmi.</p>
                        </div>
                    </div>
                </div>
                <div class="guide-callout">
                    <i class="fas fa-info-circle"></i>
                    <div>Jika dokumen dinyatakan <strong>tidak lengkap</strong>, periksa alasan pada notifikasi, lengkapi kembali melalui tombol <span class="text-highlight">Lengkapi Dokumen</span>, lalu kirim ulang.</div>
                </div>
            </div>

            <!-- ===== PANDUAN ADMIN BKD ===== -->
            <div class="guide-panel" id="panel-admin">
                <div class="guide-steps">
                    <div class="guide-step">
                        <div class="step-num">1</div>
                        <div class="step-body">
                            <h4>Masuk sebagai Admin BKD</h4>
                            <p>Login menggunakan akun dengan peran <span class="text-highlight">Admin BKD</span> untuk mengakses menu pengelolaan dan verifikasi.</p>
                        </div>
                    </div>
                    <div class="guide-step">
                        <div class="step-num">2</div>
                        <div class="step-body">
                            <h4>Kelola Data Master</h4>
                            <p>Perbarui data <span class="text-highlight">Pegawai</span>, <span class="text-highlight">Jabatan</span>, dan <span class="text-highlight">Pangkat</span> agar selalu akurat dan sinkron dengan data kepegawaian terbaru.</p>
                        </div>
                    </div>
                    <div class="guide-step">
                        <div class="step-num">3</div>
                        <div class="step-body">
                            <h4>Verifikasi Pengajuan</h4>
                            <p>Buka menu <span class="text-highlight">Pengajuan</span>, pilih pengajuan yang berstatus menunggu verifikasi, lalu periksa kelengkapan dokumen yang diunggah pegawai.</p>
                        </div>
                    </div>
                    <div class="guide-step">
                        <div class="step-num">4</div>
                        <div class="step-body">
                            <h4>Teruskan atau Tolak</h4>
                            <p>
                                Jika dokumen lengkap, set status menjadi <span class="text-highlight">Terverifikasi</span> untuk diteruskan ke Pimpinan.
                                Jika tidak lengkap, tolak dengan disertai <strong>alasan penolakan</strong> agar pegawai dapat memperbaiki.
                            </p>
                        </div>
                    </div>
                    <div class="guide-step">
                        <div class="step-num">5</div>
                        <div class="step-body">
                            <h4>Cetak Laporan</h4>
                            <p>Gunakan menu <span class="text-highlight">Laporan</span> untuk mencetak rekap pengajuan sesuai periode dan status yang diinginkan.</p>
                        </div>
                    </div>
                </div>
                <div class="guide-callout">
                    <i class="fas fa-shield-alt"></i>
                    <div>Pastikan seluruh berkas diverifikasi secara teliti. Kesalahan verifikasi berpotensi menghambat penerbitan SK pegawai.</div>
                </div>
            </div>

            <!-- ===== PANDUAN PIMPINAN ===== -->
            <div class="guide-panel" id="panel-pimpinan">
                <div class="guide-steps">
                    <div class="guide-step">
                        <div class="step-num">1</div>
                        <div class="step-body">
                            <h4>Masuk sebagai Pimpinan</h4>
                            <p>Login menggunakan akun dengan peran <span class="text-highlight">Pimpinan</span> untuk melihat dan menyetujui pengajuan yang telah diverifikasi Admin BKD.</p>
                        </div>
                    </div>
                    <div class="guide-step">
                        <div class="step-num">2</div>
                        <div class="step-body">
                            <h4>Tinjau Pengajuan</h4>
                            <p>Buka menu <span class="text-highlight">Pengajuan</span> dan telusuri daftar pengajuan yang menunggu persetujuan. Klik pada salah satu pengajuan untuk melihat rincian lengkap beserta dokumen pendukungnya.</p>
                        </div>
                    </div>
                    <div class="guide-step">
                        <div class="step-num">3</div>
                        <div class="step-body">
                            <h4>Setujui atau Tolak</h4>
                            <p>
                                Setujui pengajuan dengan klik tombol <span class="text-highlight">Setujui</span> apabila seluruh persyaratan telah terpenuhi.
                                Jika ditolak, isi alasan penolakan yang jelas agar dapat ditindaklanjuti.
                            </p>
                        </div>
                    </div>
                    <div class="guide-step">
                        <div class="step-num">4</div>
                        <div class="step-body">
                            <h4>Pantau Penerbitan SK</h4>
                            <p>Setelah disetujui, SK akan diterbitkan secara otomatis dan dapat diunduh oleh pegawai dari menu Riwayat.</p>
                        </div>
                    </div>
                </div>
                <div class="guide-callout">
                    <i class="fas fa-check-circle"></i>
                    <div>Persetujuan Pimpinan merupakan tahap akhir sebelum SK diterbitkan. Tinjau setiap pengajuan dengan cermat.</div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer-pro">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="{{ url('/') }}" class="brand-mark text-decoration-none">
                        <div class="icon-badge"><i class="fas fa-award"></i></div>
                        <span>SIPAK</span>
                    </a>
                    <p>Sistem Informasi Kenaikan Pangkat Pegawai. Portal resmi Badan Kepegawaian Daerah untuk percepatan layanan administrasi kepegawaian berbasis digital.</p>
                    <div class="footer-socials">
                        <a href="https://www.instagram.com/bkpsdmkepulauanselayar/?hl=en" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.facebook.com/BKPSDMKepulauanSelayar/" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.youtube.com/@bkkpdkepulauanselayar8220/videos" class="social-icon"><i class="fab fa-youtube"></i></a>
                        <a href="mailto:bkppd@kepulauanselayarkab.go.id" class="social-icon"><i class="fas fa-envelope"></i></a>
                    </div>
                </div>
                <div class="footer-col">
                    <h5>Navigasi</h5>
                    <ul class="footer-links">
                        <li><a href="{{ url('/') }}">Beranda</a></li>
                        <li><a href="{{ url('/#alur') }}">Alur Pengajuan</a></li>
                        <li><a href="{{ url('/#layanan') }}">Layanan & Fitur</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h5>Legal & Bantuan</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('panduan') }}" style="color: var(--primary); font-weight: 600;">Panduan Pengguna</a></li>
                        <li><a href="{{ route('kebijakan-privasi') }}">Kebijakan Privasi</a></li>
                        <li><a href="{{ route('syarat-ketentuan') }}">Syarat & Ketentuan</a></li>
                        <li><a href="{{ route('faq') }}">FAQ</a></li>
                        <li><a href="{{ route('hubungi-kami') }}">Hubungi Kami</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h5>Kontak BKD</h5>
                    <ul class="footer-contact-list">
                        <li><i class="fas fa-map-marker-alt footer-contact-icon"></i><span>Jl. Jend. Ahmad Yani, Benteng Sel., Kec. Benteng, Kab. Kepulauan Selayar, Sulawesi Selatan</span></li>
                        <li><i class="fas fa-phone footer-contact-icon"></i><span>(62) 414 21118</span></li>
                        <li><i class="fas fa-envelope footer-contact-icon"></i><span>bkppd@kepulauanselayarkab.go.id</span></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <div>&copy; {{ date('Y') }} BKD Kepulauan Selayar. Hak Cipta Dilindungi.</div>
            </div>
        </div>
    </footer>

    <script>
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('mainNav');
            nav.classList.toggle('scrolled', window.scrollY > 50);
        });

        function showGuide(tab, role) {
            document.querySelectorAll('.guide-tab').forEach(function(t) { t.classList.remove('active'); });
            document.querySelectorAll('.guide-panel').forEach(function(p) { p.classList.remove('active'); });
            tab.classList.add('active');
            document.getElementById('panel-' + role).classList.add('active');
        }
    </script>
</body>
</html>