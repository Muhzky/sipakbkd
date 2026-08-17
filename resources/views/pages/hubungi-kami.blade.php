<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - SIPAK</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
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
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.05), 0 4px 6px -2px rgba(0,0,0,0.025);
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

        .contact-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-bottom: 48px; }
        .contact-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 32px 24px;
            text-align: center;
            transition: var(--transition);
        }
        .contact-card:hover { border-color: var(--primary); box-shadow: var(--shadow-md); transform: translateY(-4px); }
        .contact-card-icon {
            width: 48px; height: 48px;
            background: var(--primary-light);
            color: var(--primary-dark);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
            margin: 0 auto 20px;
        }
        .contact-card h3 { font-size: 1rem; font-weight: 700; color: var(--text-main); margin: 0 0 8px; }
        .contact-card p { color: var(--text-muted); font-size: 0.9rem; line-height: 1.7; margin: 0; }
        .contact-card a { color: var(--primary); font-weight: 600; }
        .contact-card a:hover { color: var(--primary-dark); }

        .office-info { max-width: 760px; }
        .office-info h2 { font-size: 1.2rem; font-weight: 700; color: var(--text-main); margin: 0 0 20px; }
        .info-row { display: flex; gap: 16px; margin-bottom: 16px; }
        .info-label { font-size: 0.85rem; font-weight: 600; color: var(--text-main); min-width: 100px; }
        .info-value { font-size: 0.9rem; color: var(--text-muted); line-height: 1.6; }

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
            .contact-grid { grid-template-columns: 1fr; }
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
                <a href="{{ url('/') }}">Beranda</a> <span>/</span> Hubungi Kami
            </div>
            <h1>Hubungi Kami</h1>
            <p>Siap membantu Anda terkait layanan kenaikan pangkat di BKD Kepulauan Selayar.</p>
        </div>
    </section>

    <section class="page-content">
        <div class="container">
            <div class="contact-grid">
                <div class="contact-card">
                    <div class="contact-card-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <h3>Alamat</h3>
                    <p>Jl. Jend. Ahmad Yani, Benteng Sel., Kec. Benteng, Kab. Kepulauan Selayar, Sulawesi Selatan</p>
                </div>
                <div class="contact-card">
                    <div class="contact-card-icon"><i class="fas fa-phone"></i></div>
                    <h3>Telepon</h3>
                    <p><a href="tel:+6241421118">(62) 414 21118</a></p>
                    <p style="margin-top: 8px; font-size: 0.8rem; color: var(--text-muted);">Senin - Jumat, 08.00 - 16.00 WITA</p>
                </div>
                <div class="contact-card">
                    <div class="contact-card-icon"><i class="fas fa-envelope"></i></div>
                    <h3>Email</h3>
                    <p><a href="mailto:bkppd@kepulauanselayarkab.go.id">bkppd@kepulauanselayarkab.go.id</a></p>
                </div>
            </div>

            <div class="office-info">
                <h2>Informasi Kantor</h2>
                <div class="info-row">
                    <span class="info-label">Instansi</span>
                    <span class="info-value">Badan Kepegawaian Daerah (BKD) Kepulauan Selayar</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Jam Kerja</span>
                    <span class="info-value">Senin - Jumat, 08.00 - 16.00 WITA</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email</span>
                    <span class="info-value"><a href="mailto:bkppd@kepulauanselayarkab.go.id">bkppd@kepulauanselayarkab.go.id</a></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Telepon</span>
                    <span class="info-value"><a href="tel:+6241421118">(62) 414 21118</a></span>
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
                        <li><a href="{{ route('kebijakan-privasi') }}">Kebijakan Privasi</a></li>
                        <li><a href="{{ route('syarat-ketentuan') }}">Syarat & Ketentuan</a></li>
                        <li><a href="{{ route('faq') }}">FAQ</a></li>
                        <li><a href="{{ route('hubungi-kami') }}" style="color: var(--primary); font-weight: 600;">Hubungi Kami</a></li>
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
