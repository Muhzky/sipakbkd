<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPAK - Sistem Informasi Kenaikan Pangkat Pegawai</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts: Plus Jakarta Sans for a more modern, official feel -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            /* Refined Color Palette */
            --primary: #0F9D58;       /* Slightly deeper green for authority */
            --primary-dark: #0A5C36;
            --primary-light: #E8F5E9;
            --accent-gold: #B8860B;
            --text-main: #1E293B;     /* Slate 800 */
            --text-muted: #64748B;    /* Slate 500 */
            --bg-body: #F8FAFC;       /* Very light slate background */
            --surface: #FFFFFF;
            --border: #E2E8F0;
            
            /* Spacing & Effects */
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 20px;
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.05), 0 4px 6px -2px rgba(0,0,0,0.025);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            background-color: var(--bg-body);
            color: var(--text-main);
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            font-size: 1rem;
            line-height: 1.6;
            overflow-x: hidden;
        }

        a { text-decoration: none; transition: var(--transition); }
        
        /* ---------- Professional Navbar (Glassmorphism) ---------- */
        .navbar-pro {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            padding: 16px 0;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.6);
            transition: var(--transition);
        }
        
        .navbar-pro.scrolled {
            padding: 12px 0;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: var(--shadow-sm);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand-mark {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .brand-mark .icon-badge {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .brand-mark .icon-badge i {
            color: var(--primary-dark);
            font-size: 17px;
        }
        .brand-mark span {
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--text-main);
            letter-spacing: -0.5px;
        }

        .nav-actions { display: flex; align-items: center; gap: 24px; }
        
        .nav-link-custom {
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.9rem;
            position: relative;
        }
        .nav-link-custom:hover { color: var(--primary); }
        
        .btn-login {
            color: var(--primary-dark);
            font-weight: 700;
            font-size: 0.9rem;
            padding: 8px 16px;
        }
        
        .btn-register {
            background: var(--primary);
            color: white !important;
            font-weight: 700;
            font-size: 0.9rem;
            padding: 10px 24px;
            border-radius: 100px;
            box-shadow: 0 4px 14px rgba(15, 157, 88, 0.25);
        }
        .btn-register:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(15, 157, 88, 0.35);
        }

        /* ---------- Hero Section with Professional Diagonal Shapes ---------- */
        .hero-section {
            position: relative;
            padding: 160px 0 100px;
            overflow: hidden;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        }
        
        .hero-section .container {
            position: relative;
            z-index: 1;
        }

        /* Professional Diagonal Green Shape - Main */
        .hero-diagonal-shape {
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-light) 0%, rgba(15, 157, 88, 0.08) 100%);
            clip-path: polygon(20% 0%, 100% 0%, 100% 100%, 0% 100%);
            z-index: 0;
            opacity: 0.6;
        }
        
        /* Secondary Diagonal Accent */
        .hero-diagonal-accent {
            position: absolute;
            top: -20%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            clip-path: polygon(30% 0%, 100% 0%, 70% 100%, 0% 100%);
            z-index: 0;
            opacity: 0.05;
            transform: rotate(-15deg);
        }
        
        /* Small decorative dots pattern */
        .hero-dots-pattern {
            position: absolute;
            top: 20%;
            right: 10%;
            width: 200px;
            height: 200px;
            background-image: radial-gradient(circle, var(--primary) 2px, transparent 2px);
            background-size: 20px 20px;
            opacity: 0.15;
            z-index: 0;
        }
        
        /* Subtle abstract background shapes */
        .hero-bg-shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.3;
            z-index: -1;
        }
        .shape-1 { top: -10%; right: -5%; width: 600px; height: 600px; background: var(--primary-light); }
        .shape-2 { bottom: 10%; left: -10%; width: 400px; height: 400px; background: #E0F2FE; }
        .shape-3 { top: 50%; left: 50%; width: 300px; height: 300px; background: rgba(15, 157, 88, 0.06); transform: translate(-50%, -50%); }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary-light);
            color: var(--primary-dark);
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 6px 16px;
            border-radius: 100px;
            margin-bottom: 24px;
        }

        .hero-title {
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -1px;
            color: var(--text-main);
            margin-bottom: 24px;
        }
        .hero-title span {
            background: linear-gradient(to right, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-desc {
            font-size: 1.15rem;
            color: var(--text-muted);
            max-width: 540px;
            margin-bottom: 40px;
            line-height: 1.7;
        }

        .hero-btns { display: flex; gap: 16px; flex-wrap: wrap; margin-bottom: 60px; }
        
        .btn-primary-lg {
            background: var(--primary);
            color: white;
            font-weight: 700;
            padding: 16px 32px;
            border-radius: var(--radius-md);
            display: inline-flex; align-items: center; gap: 10px;
            font-size: 1rem;
            box-shadow: 0 8px 24px rgba(15, 157, 88, 0.2);
        }
        .btn-primary-lg:hover { 
            background: var(--primary-dark); 
            color: white; 
            transform: translateY(-2px); 
            box-shadow: 0 12px 30px rgba(15, 157, 88, 0.3);
        }

        .btn-outline-lg {
            background: white;
            color: var(--text-main);
            font-weight: 700;
            padding: 16px 32px;
            border-radius: var(--radius-md);
            border: 1px solid var(--border);
            display: inline-flex; align-items: center; gap: 10px;
            font-size: 1rem;
        }
        .btn-outline-lg:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
        }

        /* Stats Row */
        .stats-row {
            display: flex;
            gap: 48px;
            padding-top: 32px;
            border-top: 1px solid var(--border);
        }
        .stat-item h3 {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-main);
            margin: 0;
            line-height: 1;
        }
        .stat-item p {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 8px 0 0;
        }

        /* ---------- Alur Pengajuan (Timeline) ---------- */
        .section-padding { padding: 100px 0; }
        
        .section-header { text-align: center; max-width: 600px; margin: 0 auto 64px; }
        .section-label {
            color: var(--primary);
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 12px;
            display: block;
        }
        .section-title {
            font-size: 2.25rem;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }
        .section-subtitle { color: var(--text-muted); font-size: 1.05rem; }

        .timeline-wrapper {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            position: relative;
        }
        
        /* Connecting Line behind cards */
        .timeline-line {
            position: absolute;
            top: 48px; left: 12.5%; right: 12.5%;
            height: 2px;
            background: repeating-linear-gradient(90deg, var(--border) 0, var(--border) 8px, transparent 8px, transparent 16px);
            z-index: 0;
        }

        .timeline-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 32px 24px;
            position: relative;
            z-index: 1;
            transition: var(--transition);
        }
        .timeline-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-light);
        }

        .step-number {
            width: 48px; height: 48px;
            background: var(--surface);
            border: 2px solid var(--border);
            color: var(--text-muted);
            font-weight: 800;
            font-size: 1.1rem;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 20px;
            transition: var(--transition);
        }
        .timeline-card:hover .step-number {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
            box-shadow: 0 4px 12px rgba(15, 157, 88, 0.3);
        }

        .timeline-card h4 { font-size: 1.1rem; font-weight: 700; margin-bottom: 10px; color: var(--text-main); }
        .timeline-card p { font-size: 0.9rem; color: var(--text-muted); margin: 0; line-height: 1.6; }

        /* ---------- Features Grid ---------- */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }
        
        .feature-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 32px;
            transition: var(--transition);
        }
        .feature-card:hover {
            border-color: var(--primary);
            box-shadow: var(--shadow-md);
            transform: translateY(-4px);
        }
        
        .feature-icon {
            width: 52px; height: 52px;
            background: var(--primary-light);
            color: var(--primary-dark);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.25rem;
            margin-bottom: 24px;
        }
        
        .feature-card h4 { font-size: 1.1rem; font-weight: 700; margin-bottom: 12px; }
        .feature-card p { font-size: 0.9rem; color: var(--text-muted); margin: 0; line-height: 1.6; }

        /* ---------- CTA Band ---------- */
        .cta-band {
            background: linear-gradient(135deg, var(--primary-dark), #053b22);
            border-radius: 24px;
            padding: 64px 48px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
            margin-top: 40px;
        }
        /* Abstract pattern overlay */
        .cta-band::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: radial-gradient(circle at 20% 50%, rgba(255,255,255,0.05) 0%, transparent 50%),
                              radial-gradient(circle at 80% 20%, rgba(255,255,255,0.08) 0%, transparent 40%);
            pointer-events: none;
        }
        
        .cta-band h3 { font-size: 2rem; font-weight: 800; margin-bottom: 16px; position: relative; z-index: 1; }
        .cta-band p { color: rgba(255,255,255,0.8); font-size: 1.1rem; margin-bottom: 32px; max-width: 500px; margin-left: auto; margin-right: auto; position: relative; z-index: 1; }
        
        .btn-white {
            background: white;
            color: var(--primary-dark);
            font-weight: 700;
            padding: 16px 36px;
            border-radius: 100px;
            display: inline-flex; align-items: center; gap: 10px;
            font-size: 1rem;
            position: relative; z-index: 1;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        .btn-white:hover {
            background: var(--primary-light);
            color: var(--primary-dark);
            transform: translateY(-2px);
        }

        /* ---------- Professional Footer ---------- */
        .footer-pro {
            background: var(--surface);
            border-top: 1px solid var(--border);
            padding: 80px 0 32px;
            margin-top: 100px;
            font-size: 0.9rem;
        }
        
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 48px;
            margin-bottom: 64px;
        }
        
        .footer-brand p {
            color: var(--text-muted);
            margin-top: 16px;
            max-width: 280px;
            line-height: 1.7;
        }
        
        .footer-col h5 {
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-main);
            margin-bottom: 24px;
        }
        
        .footer-links { list-style: none; padding: 0; margin: 0; }
        .footer-links li { margin-bottom: 12px; }
        .footer-links a {
            color: var(--text-muted);
            font-weight: 500;
            display: inline-block;
        }
        .footer-links a:hover { color: var(--primary); transform: translateX(4px); }
        
        .footer-contact-list { list-style: none; padding: 0; margin: 0; }
        .footer-contact-list li { display: flex; align-items: flex-start; gap: 8px; margin-bottom: 12px; }
        .footer-contact-icon { color: var(--primary) !important; flex-shrink: 0; margin-top: 3px; }
        
        .footer-socials { display: flex; gap: 12px; margin-top: 24px; }
        .social-icon {
            width: 36px; height: 36px;
            background: var(--bg-body);
            border: 1px solid var(--border);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: var(--text-muted);
            transition: var(--transition);
        }
        .social-icon:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .footer-bottom {
            padding-top: 32px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--ink-faint);
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .hero-section { padding: 120px 0 60px; text-align: center; }
            .hero-desc { margin: 0 auto 32px; }
            .hero-btns { justify-content: center; }
            .stats-row { justify-content: center; }
            .timeline-wrapper { grid-template-columns: repeat(2, 1fr); }
            .timeline-line { display: none; }
            .features-grid { grid-template-columns: repeat(2, 1fr); }
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 32px; }
            .hero-diagonal-shape { width: 50%; opacity: 0.5; }
            .hero-diagonal-accent { width: 350px; height: 350px; top: -15%; right: -15%; opacity: 0.04; }
            .hero-dots-pattern { width: 150px; height: 150px; top: 15%; right: 5%; background-size: 18px 18px; }
            .shape-1 { width: 400px; height: 400px; }
            .shape-2 { width: 300px; height: 300px; }
            .shape-3 { width: 200px; height: 200px; }
        }

        @media (max-width: 768px) {
            .nav-actions .nav-link-custom { display: none; }
            .timeline-wrapper { grid-template-columns: 1fr; }
            .features-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr; gap: 40px; }
            .footer-bottom { flex-direction: column; gap: 16px; text-align: center; }
            .cta-band { padding: 48px 24px; }
            .hero-diagonal-shape { width: 45%; opacity: 0.35; clip-path: polygon(25% 0%, 100% 0%, 100% 100%, 0% 100%); }
            .hero-diagonal-accent { display: none; }
            .hero-dots-pattern { display: none; }
            .hero-bg-shape { opacity: 0.5; }
            .shape-1 { width: 300px; height: 300px; top: -5%; right: -10%; }
            .shape-2 { width: 250px; height: 250px; bottom: 5%; left: -15%; }
            .shape-3 { width: 180px; height: 180px; }
        }

        @media (max-width: 480px) {
            .hero-section { padding: 90px 0 32px; }
            .hero-title { font-size: clamp(1.75rem, 7vw, 2.2rem); }
            .hero-desc { font-size: 0.95rem; }
            .hero-btns { flex-direction: column; align-items: center; }
            .btn-primary-lg, .btn-outline-lg { width: 100%; justify-content: center; padding: 14px 24px; font-size: 0.95rem; }
            .stats-row { gap: 24px; flex-wrap: wrap; }
            .stat-item h3 { font-size: 1.5rem; }
            .stat-item p { font-size: 0.75rem; }
            .hero-diagonal-shape { width: 35%; opacity: 0.25; clip-path: polygon(35% 0%, 100% 0%, 100% 100%, 0% 100%); }
            .shape-1 { width: 180px; height: 180px; top: -5%; right: -15%; }
            .shape-2 { width: 150px; height: 150px; }
            .shape-3 { display: none; }
        }
    </style>
</head>
<body>

    <!-- Modern Glassmorphism Navbar -->
    <nav class="navbar-pro" id="mainNav">
        <div class="nav-container">
            <a href="#" class="brand-mark text-decoration-none">
                <div class="icon-badge"><i class="fas fa-award"></i></div>
                <span>SIPAK</span>
            </a>
            <div class="nav-actions">
                <a href="#alur" class="nav-link-custom">Alur Pengajuan</a>
                <a href="#layanan" class="nav-link-custom">Layanan</a>
                <a href="{{ route('login') }}" class="btn-login">Masuk</a>
                <a href="{{ route('register') }}" class="btn-register">Daftar</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Professional Diagonal Shapes -->
    <section class="hero-section">
        <!-- Professional Diagonal Background Elements -->
        <div class="hero-diagonal-shape"></div>
        <div class="hero-diagonal-accent"></div>
        <div class="hero-dots-pattern"></div>
        <div class="hero-bg-shape shape-1"></div>
        <div class="hero-bg-shape shape-2"></div>
        <div class="hero-bg-shape shape-3"></div>
        
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="hero-badge">
                        <i class="fas fa-shield-halved"></i> Badan Kepegawaian Daerah
                    </div>
                    <h1 class="hero-title">Sistem Kenaikan Pangkat Pegawai, <span>tanpa antre berkas.</span></h1>
                    <p class="hero-desc">SIPAK menyatukan pengajuan, verifikasi, dan penerbitan SK kenaikan pangkat dalam satu portal digital yang transparan dan dapat dipantau kapan saja.</p>
                    
                    <div class="hero-btns">
                        <a href="{{ route('register') }}" class="btn-primary-lg">
                            <i class="fas fa-file-circle-plus"></i> Ajukan Sekarang
                        </a>
                        <a href="{{ route('login') }}" class="btn-outline-lg">
                            <i class="fas fa-user"></i> Masuk ke Akun
                        </a>
                    </div>

                    <div class="stats-row">
                        <div class="stat-item">
                            <h3>100%</h3>
                            <p>Berkas Digital</p>
                        </div>
                        <div class="stat-item">
                            <h3>4 Tahap</h3>
                            <p>Proses Transparan</p>
                        </div>
                        <div class="stat-item">
                            <h3>24/7</h3>
                            <p>Pantau Status</p>
                        </div>
                    </div>
                </div>
                <!-- Optional: Add an illustration or dashboard preview image on the right side here -->
            </div>
        </div>
    </section>

    <!-- Alur Pengajuan -->
    <section class="section-padding" id="alur">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Alur Pengajuan</span>
                <h2 class="section-title">Empat tahap menuju SK baru Anda</h2>
                <p class="section-subtitle">Setiap usulan berjalan melalui tahapan standar yang dapat dipantau secara langsung oleh pegawai maupun tim kepegawaian.</p>
            </div>

            <div class="timeline-wrapper">
                <div class="timeline-line"></div>
                
                <div class="timeline-card">
                    <div class="step-number">01</div>
                    <h4>Ajukan Berkas</h4>
                    <p>Unggah dokumen persyaratan kenaikan pangkat langsung dari dashboard akun pribadi Anda.</p>
                </div>
                <div class="timeline-card">
                    <div class="step-number">02</div>
                    <h4>Verifikasi Berkas</h4>
                    <p>Tim kepegawaian memeriksa kelengkapan dan keabsahan dokumen yang telah diunggah.</p>
                </div>
                <div class="timeline-card">
                    <div class="step-number">03</div>
                    <h4>Penilaian Baperjakat</h4>
                    <p>Usulan dinilai dan direkomendasikan oleh tim pertimbangan jabatan dan kepangkatan.</p>
                </div>
                <div class="timeline-card">
                    <div class="step-number">04</div>
                    <h4>SK Diterbitkan</h4>
                    <p>Surat Keputusan kenaikan pangkat terbit secara digital dan siap diunduh melalui portal.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan / Features -->
    <section class="section-padding" id="layanan" style="background: white;">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Fitur Unggulan</span>
                <h2 class="section-title">Semua kebutuhan dalam satu portal</h2>
                <p class="section-subtitle">Dirancang khusus untuk memudahkan pengelolaan proses kenaikan pangkat bagi pegawai dan admin.</p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-folder-open"></i></div>
                    <h4>Arsip Digital Terpusat</h4>
                    <p>Seluruh riwayat dokumen kepegawaian tersimpan aman dan dapat diakses kembali kapan saja tanpa kertas.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                    <h4>Pelacakan Real-time</h4>
                    <p>Pantau posisi berkas usulan secara langsung, mulai dari tahap pengajuan hingga penerbitan SK.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-bell"></i></div>
                    <h4>Notifikasi Otomatis</h4>
                    <p>Dapatkan pemberitahuan instan melalui email atau dashboard setiap kali status usulan Anda berubah.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-lock"></i></div>
                    <h4>Keamanan Data Tinggi</h4>
                    <p>Data kepegawaian dilindungi dengan enkripsi standar instansi pemerintah dan kontrol akses berlapis.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-users"></i></div>
                    <h4>Kolaborasi Tim</h4>
                    <p>Tim kepegawaian dan Baperjakat bekerja pada satu ekosistem data yang sama, menghilangkan duplikasi.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-file-contract"></i></div>
                    <h4>SK Digital Resmi</h4>
                    <p>Surat Keputusan yang telah disetujui dapat langsung diunduh dalam format PDF resmi yang sah.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Band -->
    <section class="section-padding" style="padding-top: 0;">
        <div class="container">
            <div class="cta-band">
                <h3>Siap mengajukan kenaikan pangkat Anda?</h3>
                <p>Buat akun dalam hitungan menit dan mulailah lacak proses usulan kenaikan pangkat Anda hari ini juga.</p>
                <a href="{{ route('register') }}" class="btn-white">
                    Daftar Sekarang <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Professional Multi-Column Footer -->
    <footer class="footer-pro">
        <div class="container">
            <div class="footer-grid">
                <!-- Brand Column -->
                <div class="footer-brand">
                    <a href="#" class="brand-mark text-decoration-none">
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

                <!-- Navigation Column -->
                <div class="footer-col">
                    <h5>Navigasi</h5>
                    <ul class="footer-links">
                        <li><a href="#">Beranda</a></li>
                        <li><a href="#alur">Alur Pengajuan</a></li>
                        <li><a href="#layanan">Layanan & Fitur</a></li>
                        <li><a href="{{ route('panduan') }}">Panduan Pengguna</a></li>
                    </ul>
                </div>

                <!-- Legal Column -->
                <div class="footer-col">
                    <h5>Legal & Bantuan</h5>
                    <ul class="footer-links">
                        
                        <li><a href="{{ route('kebijakan-privasi') }}">Kebijakan Privasi</a></li>
                        <li><a href="{{ route('syarat-ketentuan') }}">Syarat & Ketentuan</a></li>
                        <li><a href="{{ route('faq') }}">FAQ</a></li>
                        <li><a href="{{ route('hubungi-kami') }}">Hubungi Kami</a></li>
                    </ul>
                </div>

                <!-- Contact Column -->
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

    <!-- Simple JS for Navbar Scroll Effect -->
    <script>
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('mainNav');
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>