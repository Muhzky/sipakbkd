<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - SIPAK</title>
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
        .faq-list { max-width: 760px; }
        .faq-item {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            margin-bottom: 12px;
            overflow: hidden;
            transition: var(--transition);
        }
        .faq-item:hover { border-color: rgba(15,157,88,0.3); }
        .faq-question {
            padding: 20px 24px;
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--text-main);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            user-select: none;
        }
        .faq-question:hover { color: var(--primary); }
        .faq-question i { color: var(--primary); font-size: 0.8rem; flex-shrink: 0; transition: transform 0.25s; }
        .faq-answer {
            padding: 0 24px 20px;
            color: var(--text-muted);
            line-height: 1.8;
            font-size: 0.95rem;
            display: none;
        }
        .faq-item.active .faq-question i { transform: rotate(180deg); }
        .faq-item.active .faq-answer { display: block; }
        .faq-item.active { border-color: var(--primary); }

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
                <a href="{{ url('/') }}">Beranda</a> <span>/</span> Pertanyaan Umum
            </div>
            <h1>Pertanyaan Umum</h1>
            <p>Jawaban atas pertanyaan yang sering diajukan seputar penggunaan SIPAK.</p>
        </div>
    </section>

    <section class="page-content">
        <div class="container">
            <div class="faq-list">
                <div class="faq-item active">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        Apa itu SIPAK?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        SIPAK (Sistem Informasi Kenaikan Pangkat Pegawai) adalah portal digital resmi BKD Kepulauan Selayar yang memungkinkan pegawai mengajukan kenaikan pangkat secara online. Melalui sistem ini, Anda dapat mengunggah berkas, memantau status pengajuan, dan mengunduh SK tanpa perlu datang langsung ke kantor BKD.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        Bagaimana cara membuat akun SIPAK?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Klik tombol "Daftar" pada halaman utama, lalu isi data diri Anda meliputi NIP, nama lengkap, alamat email aktif, dan kata sandi. Setelah proses registrasi selesai, Anda akan menerima email konfirmasi dan dapat langsung login ke dashboard.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        Dokumen apa saja yang perlu disiapkan?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Persyaratan umum meliputi: SK pangkat terakhir, SK jabatan, surat keterangan masa kerja, penilaian prestasi kerja, dan surat pengantar dari instansi. Ketentuan lengkap dapat dilihat pada panduan pengajuan di dashboard setelah Anda login.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        Berapa lama proses verifikasi berlangsung?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Proses verifikasi oleh tim kepegawaian biasanya memakan waktu 3-7 hari kerja. Waktu ini dapat bervariasi tergantung kelengkapan dokumen dan jumlah antrian pengajuan. Anda akan menerima notifikasi setiap kali terdapat perubahan status.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        Apa yang harus dilakukan jika dokumen ditolak?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Jika dokumen Anda ditolak, Anda akan menerima notifikasi beserta rincian alasan penolakan. Periksa kembali dokumen yang diminta, lakukan koreksi yang diperlukan, dan unggah ulang melalui dashboard. Pengajuan akan diproses kembali setelah dokumen lengkap.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        Bagaimana cara mengunduh SK yang sudah terbit?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Setelah pengajuan disetujui dan SK diterbitkan, Anda akan menerima notifikasi email. Login ke akun SIPAK, buka menu Riwayat Pengajuan, lalu klik tombol "Unduh SK" pada pengajuan yang telah selesai. SK tersedia dalam format PDF resmi.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        Bagaimana cara menghubungi BKD jika mengalami kendala?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Anda dapat menghubungi BKD Kepulauan Selayar melalui email bkppd@kepulauanselayarkab.go.id atau telepon (62) 414 21118 pada hari kerja (Senin-Jumat, pukul 08.00-16.00 WITA). Kunjungi juga halaman <a href="{{ route('hubungi-kami') }}" style="color: var(--primary); font-weight: 600;">Hubungi Kami</a> untuk informasi lebih lengkap.
                    </div>
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
                        <li><a href="{{ route('panduan') }}">Panduan Pengguna</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h5>Legal & Bantuan</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('kebijakan-privasi') }}">Kebijakan Privasi</a></li>
                        <li><a href="{{ route('syarat-ketentuan') }}">Syarat & Ketentuan</a></li>
                        <li><a href="{{ route('faq') }}" style="color: var(--primary); font-weight: 600;">FAQ</a></li>
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

        function toggleFaq(el) {
            const item = el.parentElement;
            const wasActive = item.classList.contains('active');
            document.querySelectorAll('.faq-item').forEach(function(i) { i.classList.remove('active'); });
            if (!wasActive) item.classList.add('active');
        }
    </script>
</body>
</html>
