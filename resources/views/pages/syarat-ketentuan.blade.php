<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syarat & Ketentuan - SIPAK</title>
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
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 20px;
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
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
        .content-article { max-width: 760px; }
        .content-article h2 { font-size: 1.2rem; font-weight: 700; color: var(--text-main); margin: 40px 0 12px; padding-top: 24px; border-top: 1px solid var(--border); }
        .content-article h2:first-child { margin-top: 0; border-top: none; padding-top: 0; }
        .content-article p { color: var(--text-muted); line-height: 1.8; font-size: 0.95rem; margin-bottom: 12px; }
        .content-article ul { padding-left: 20px; margin-bottom: 12px; }
        .content-article li { color: var(--text-muted); line-height: 1.8; font-size: 0.95rem; margin-bottom: 6px; }

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
                <a href="{{ url('/') }}">Beranda</a> <span>/</span> Syarat & Ketentuan
            </div>
            <h1>Syarat & Ketentuan</h1>
            <p>Ketentuan penggunaan layanan SIPAK yang berlaku bagi seluruh pengguna.</p>
        </div>
    </section>

    <section class="page-content">
        <div class="container">
            <article class="content-article">
                <h2>1. Penerimaan Syarat</h2>
                <p>Dengan mengakses dan menggunakan SIPAK, Anda menyetujui untuk terikat oleh syarat dan ketentuan ini. Jika Anda tidak setuju dengan ketentuan yang berlaku, mohon untuk tidak menggunakan layanan ini.</p>

                <h2>2. Eligibilitas Pengguna</h2>
                <p>Layanan SIPAK diperuntukkan bagi:</p>
                <ul>
                    <li>Pegawai Negeri Sipil (PNS) di lingkungan Pemerintah Kabupaten Kepulauan Selayar yang terdaftar dalam database BKD</li>
                    <li>Operator BKD yang ditunjuk secara resmi untuk mengelola pengajuan</li>
                    <li>Pimpinan yang berwenang melakukan persetujuan kenaikan pangkat</li>
                </ul>

                <h2>3. Pendaftaran Akun</h2>
                <p>Setiap pengguna wajib mendaftar dengan data yang valid dan dapat diverifikasi. Pengguna bertanggung jawab penuh atas kerahasiaan akun masing-masing dan wajib segera melaporkan jika terjadi penyalahgunaan akun.</p>

                <h2>4. Pengajuan Dokumen</h2>
                <p>Pengguna wajib memastikan bahwa seluruh dokumen yang diunggah adalah dokumen asli yang sah dan valid. Dokumen palsu atau tidak sesuai akan mengakibatkan penolakan pengajuan dan dapat dikenakan sanksi sesuai ketentuan peraturan perundang-undangan.</p>

                <h2>5. Proses Verifikasi</h2>
                <p>BKD Kepulauan Selayar berhak melakukan verifikasi terhadap setiap pengajuan yang masuk. Hasil verifikasi bersifat final dan dapat dipertanggungjawabkan secara hukum. Pengguna akan menerima pemberitahuan mengenai status verifikasi melalui sistem.</p>

                <h2>6. Pembatalan Pengajuan</h2>
                <p>Pengajuan dapat dibatalkan oleh pengguna sebelum memasuki tahap verifikasi. Setelah melampaui tahap tertentu, pembatalan memerlukan prosedur khusus dan persetujuan dari pejabat yang berwenang.</p>

                <h2>7. Hak dan Kewajiban Pengguna</h2>
                <p>Pengguna berhak mendapatkan layanan yang transparan dan akuntabel. Pengguna wajib menggunakan layanan sesuai ketentuan yang berlaku dan tidak menyalahgunakan sistem untuk kepentingan di luar proses kenaikan pangkat.</p>

                <h2>8. Pembatasan Tanggung Jawab</h2>
                <p>BKD Kepulauan Selayar tidak bertanggung jawab atas kerugian yang timbul akibat penggunaan layanan yang tidak sesuai dengan ketentuan, gangguan teknis di luar kendali, atau force majeure.</p>

                <h2>9. Perubahan Ketentuan</h2>
                <p>BKD berhak mengubah syarat dan ketentuan ini sewaktu-waktu sesuai kebutuhan dan perkembangan regulasi. Perubahan akan diberitahukan melalui portal SIPAK dan berlaku sejak tanggal pengumuman.</p>
            </article>
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
                        <li><a href="{{ route('syarat-ketentuan') }}" style="color: var(--primary); font-weight: 600;">Syarat & Ketentuan</a></li>
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
    </script>
</body>
</html>
