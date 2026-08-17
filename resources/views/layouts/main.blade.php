<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Kenaikan Pangkat BKD')</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @stack('styles')
    <style>
        :root {
            --primary: #12A150;
            --primary-dark: #0B5C33;
            --mint: #EAF7EF;
            --text: #34395E;
            --border: #E4E6EF;
            --success: #12A150;
            --info: #2F9E8F;
            --warning: #E8A33D;
            --danger: #D9534F;
            --muted: #9095ac;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        /* ===== Border tabel data (abu-abu) ===== */
        .table th, .table td,
        table.dataTable th, table.dataTable td,
        .table-pengajuan th, .table-pengajuan td,
        .table-riwayat th, .table-riwayat td,
        .table-laporan th, .table-laporan td,
        thead th, thead td, tbody th, tbody td, tfoot th, tfoot td {
            border: 1px solid #ccc;
        }

        body {
            font-family: 'Poppins', 'Nunito', 'Segoe UI', Tahoma, sans-serif;
            background-color: #FAFBFC;
            color: var(--text);
            min-height: 100vh;
        }

        /* ===== SIDEBAR (flex column: brand / menu / footer) ===== */
        .main-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 260px;
            background: #ffffff;
            border-right: 1px solid var(--border);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease, width 0.3s ease;
        }

        .main-sidebar .sidebar-brand {
            padding: 24px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid var(--border);
        }
        .main-sidebar .sidebar-brand .icon-badge {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--mint);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .main-sidebar .sidebar-brand .icon-badge img { width: 20px; }
        .main-sidebar .sidebar-brand h3 {
            color: var(--text);
            font-size: 15px;
            font-weight: 700;
            line-height: 1.2;
        }
        .main-sidebar .sidebar-brand small {
            color: var(--muted);
            font-size: 10.5px;
        }

        .main-sidebar .sidebar-menu {
            flex: 1;
            overflow-y: auto;
            padding: 16px 0;
        }

        .main-sidebar .sidebar-menu .menu-header {
            padding: 14px 22px 8px;
            color: #b8bccf;
            font-size: 10.5px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-weight: 700;
        }

        .main-sidebar .sidebar-menu li { list-style: none; padding: 0 12px; }

        .main-sidebar .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 20px 14px;
            margin-bottom: 2px;
            color: #6b7086;
            text-decoration: none;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 500;
            border-left: 3px solid transparent;
            transition: all 0.2s;
        }

        .main-sidebar .sidebar-menu li a:hover {
            background: var(--mint);
            color: var(--primary-dark);
        }

        .main-sidebar .sidebar-menu li a.active {
            background: var(--mint);
            color: var(--primary-dark);
            border-left: 3px solid var(--primary);
            font-weight: 600;
        }

        .main-sidebar .sidebar-menu li a i { width: 18px; font-size: 15px; text-align: center; }

        /* Footer sidebar: logout, selalu di bawah */
        .main-sidebar .sidebar-footer {
            border-top: 1px solid var(--border);
            padding: 16px;
        }

        .sidebar-user-info {
            display: none;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            margin-bottom: 12px;
            border-bottom: 1px solid var(--border);
        }
        .sidebar-user-info .sidebar-user-detail {
            flex: 1;
            min-width: 0;
        }
        .sidebar-user-info .sidebar-user-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .sidebar-user-info .sidebar-user-role {
            font-size: 11px;
            color: var(--muted);
        }

        .btn-logout-sidebar {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px;
            border: 1px solid #f5c6c6;
            background: #fdecec;
            color: #c0392b;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s;
        }
        .btn-logout-sidebar:hover {
            background: #c0392b;
            color: #fff;
            border-color: #c0392b;
        }

        /* ===== MOBILE / TABLET TOGGLE ELEMENTS ===== */
        .btn-sidebar-toggle {
            display: none;
            border: none;
            background: transparent;
            font-size: 20px;
            color: var(--text);
            padding: 6px 10px;
            margin-right: 10px;
            cursor: pointer;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(52, 57, 94, 0.45);
            z-index: 999;
        }
        .sidebar-overlay.active { display: block; }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s ease;
        }

        .main-content .section {
            flex: 1;
        }

        .main-content .navbar {
            position: sticky;
            top: 0;
            z-index: 999;
            background: white;
            border-bottom: 1px solid var(--border);
            padding: 16px 30px;
            display: flex;
            align-items: center;
        }

        .main-content .navbar .navbar-brand { display: none; }

        .main-content .navbar .container-fluid {
            display: flex;
            align-items: center;
            width: 100%;
        }

        .main-content .navbar .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .main-content .navbar .user-info .user-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
        }

        .main-content .navbar .user-info .user-role {
            font-size: 12px;
            color: var(--muted);
        }

        .main-content .section { padding: 30px; }

        .main-content .section .section-header { margin-bottom: 25px; }

        .main-content .section .section-header h1 {
            font-size: 23px;
            font-weight: 700;
            color: var(--text);
            font-family: 'Poppins', sans-serif;
        }

        .main-content .section .section-header .section-header-breadcrumb {
            color: var(--muted);
            font-size: 13px;
        }

        .card {
            border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(52,57,94,0.04);
            margin-bottom: 25px;
        }

        .card .card-header {
            background: white;
            border-bottom: 1px solid var(--border);
            padding: 16px 24px;
            font-weight: 600;
            color: var(--text);
            border-radius: 12px 12px 0 0;
        }

        .card .card-body { padding: 24px; }

        /* Statistic card: flat + border warna solid, ikon dalam lingkaran (bukan gradient penuh) */
        .statistic-card {
            border-radius: 12px;
            padding: 22px;
            background: #fff;
            border: 1px solid var(--border);
            border-left: 4px solid var(--stat-color, var(--primary));
            position: relative;
            box-shadow: 0 6px 16px rgba(52,57,94,0.04);
        }

        .statistic-card .statistic-icon {
            position: absolute;
            right: 20px;
            top: 20px;
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: var(--stat-color, var(--primary));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            opacity: 1;
        }

        .statistic-card .statistic-label {
            font-size: 10.5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 700;
            color: var(--muted);
            margin-bottom: 8px;
        }

        .statistic-card .statistic-value {
            font-size: 26px;
            font-weight: 700;
            color: var(--text);
            font-family: 'Poppins', sans-serif;
        }

        .bg-primary-stat { --stat-color: #4A5AC7; }
        .bg-success-stat { --stat-color: var(--primary); }
        .bg-warning-stat { --stat-color: var(--warning); }
        .bg-danger-stat  { --stat-color: var(--danger); }
        .bg-info-stat    { --stat-color: var(--info); }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .badge-menunggu { background-color: var(--warning); }
        .badge-diproses { background-color: var(--info); }
        .badge-dokumen_tidak_lengkap { background-color: #e67e22; }
        .badge-menunggu_verifikasi { background-color: var(--info); }
        .badge-ditolak_operator { background-color: #e74c3c; }
        .badge-terverifikasi { background-color: #3498db; }
        .badge-disetujui { background-color: var(--primary); }
        .badge-ditolak { background-color: var(--danger); }

        .footer {
            background: white;
            padding: 18px 30px;
            margin-top: 20px;
            border-top: 1px solid var(--border);
            font-size: 12.5px;
            color: var(--muted);
        }

        .avatar { width: 50px; height: 50px; border-radius: 50%; object-fit: cover; }
        .avatar-sm { width: 35px; height: 35px; border-radius: 50%; object-fit: cover; }
        .avatar-xl {
            width: 120px; height: 120px; border-radius: 50%; object-fit: cover;
            border: 3px solid white; box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .alert { border: none; border-radius: 8px; }
        .alert-success { background: var(--mint); color: var(--primary-dark); }
        .alert-danger { background: #fdecec; color: #c0392b; }

        /* ===== NOTIFICATION BELL – DESKTOP: sejajar dengan user-info ===== */
        .main-content .navbar .collapse.navbar-collapse {
            flex-grow: 0;
        }

        /* ===== NOTIFICATION DROPDOWN – MOBILE: tidak rapat ke tepi ===== */
        @media (max-width: 575.98px) {
            .main-content .navbar .dropdown {
                margin-left: 0.5rem;
                margin-right: 0.5rem;
                
            }
            .main-content .navbar .dropdown-menu.show {
                width: calc(94vw - 30px) !important;
                min-width: 280px;
            }
        }

        /* ===== RESPONSIVE: TABLET & MOBILE (off-canvas sidebar) ===== */
        @media (max-width: 991.98px) {
            .btn-sidebar-toggle { display: inline-block; }

            .main-sidebar {
                width: 260px;
                transform: translateX(-100%);
                box-shadow: 0 0 24px rgba(0,0,0,0.15);
            }
            .main-sidebar.sidebar-open {
                transform: translateX(0);
            }

            .main-sidebar .sidebar-menu li a { justify-content: flex-start; }

            .main-content { margin-left: 0; }

            .main-content .navbar { padding: 14px 16px; }
            .main-content .section { padding: 20px; }

            .main-content .navbar .user-info .text-end { display: none; }

            .sidebar-user-info { display: flex; }
        }

        /* ===== RESPONSIVE: SMALL TABLETS / LARGE PHONES ===== */
        @media (max-width: 767.98px) {
            .card .card-body { padding: 18px; }
            .main-content .section { padding: 16px; }
            .main-content .section .section-header h1 { font-size: 19px; }

            .statistic-card { padding: 18px; }
            .statistic-card .statistic-value { font-size: 22px; }
            .statistic-card .statistic-icon {
                width: 36px;
                height: 36px;
                font-size: 15px;
                right: 16px;
                top: 16px;
            }
        }

        /* ===== RESPONSIVE: PHONES (Android/iPhone) ===== */
        @media (max-width: 480px) {
            .main-content .navbar { padding: 12px 14px; }
            .card .card-header { padding: 14px 16px; }
            .card .card-body { padding: 14px; }

            .statistic-card { padding: 14px; }
            .statistic-card .statistic-label { font-size: 9.5px; }
            .statistic-card .statistic-value { font-size: 20px; }

            .footer { padding: 14px 16px; font-size: 11px; }

            .avatar-sm { width: 30px; height: 30px; }
        }

        /* Landscape phones: reclaim vertical space */
        @media (max-height: 480px) and (orientation: landscape) {
            .main-sidebar .sidebar-brand { padding: 14px 16px; }
            .main-sidebar .sidebar-menu li a { padding: 12px 14px; }
        }
    </style>
</head>
<body>
    <div class="main-sidebar" id="mainSidebar">
        <div class="sidebar-brand">
            <div class="icon-badge"><i class="fas fa-award"></i></div>
            <div>
                <h3>BKD</h3>
                <small>Badan Kepegawaian Daerah</small>
            </div>
        </div>

        <div class="sidebar-menu">
            <ul class="list-unstyled">
                <li class="menu-header">Menu Utama</li>
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i> <span>Dashboard</span>
                    </a>
                </li>

                @role('Pegawai')
                <li>
                    <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'active' : '' }}">
                        <i class="fas fa-user"></i> <span>Profil</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pegawai.pengajuan.create') }}" class="{{ request()->routeIs('pegawai.pengajuan.create') ? 'active' : '' }}">
                        <i class="fas fa-plus-circle"></i> <span>Ajukan Kenaikan Pangkat</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pegawai.riwayat') }}" class="{{ request()->routeIs('pegawai.riwayat') || request()->routeIs('pegawai.pengajuan.show') ? 'active' : '' }}">
                        <i class="fas fa-history"></i> <span>Riwayat Pengajuan</span>
                    </a>
                </li>
                @endrole

                @role('Admin BKD')
                <li class="menu-header">Master Data</li>
                <li>
                    <a href="{{ route('admin.pegawai.index') }}" class="{{ request()->routeIs('admin.pegawai.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i> <span>Data Pegawai</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.jabatan.index') }}" class="{{ request()->routeIs('admin.jabatan.*') ? 'active' : '' }}">
                        <i class="fas fa-briefcase"></i> <span>Data Jabatan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pangkat.index') }}" class="{{ request()->routeIs('admin.pangkat.*') ? 'active' : '' }}">
                        <i class="fas fa-layer-group"></i> <span>Data Pangkat</span>
                    </a>
                </li>
                <li class="menu-header">Pengajuan</li>
                <li>
                    <a href="{{ route('admin.pengajuan.index') }}" class="{{ request()->routeIs('admin.pengajuan.*') ? 'active' : '' }}">
                        <i class="fas fa-file-alt"></i> <span>Pengajuan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.laporan.index') }}" class="{{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                        <i class="fas fa-print"></i> <span>Laporan</span>
                    </a>
                </li>
                @endrole

                @role('Pimpinan')
                <li>
                    <a href="{{ route('pimpinan.pengajuan.index') }}" class="{{ request()->routeIs('pimpinan.pengajuan.*') ? 'active' : '' }}">
                        <i class="fas fa-file-alt"></i> <span>Data Pengajuan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pimpinan.laporan.index') }}" class="{{ request()->routeIs('pimpinan.laporan.*') ? 'active' : '' }}">
                        <i class="fas fa-print"></i> <span>Laporan</span>
                    </a>
                </li>
                @endrole
            </ul>
        </div>

        <!-- ===== FOOTER SIDEBAR: user info (mobile) + logout ===== -->
        <div class="sidebar-footer">
            <a href="{{ route('profil') }}" class="text-decoration-none" style="color: inherit;">
                <div class="sidebar-user-info">
                    <div class="sidebar-user-avatar">
                        @if(Auth::user()->foto)
                            <img src="{{ supabase_storage_url(Auth::user()->foto) }}" class="avatar-sm">
                        @else
                            <div class="avatar-sm bg-primary text-white d-flex align-items-center justify-content-center">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                    </div>
                    <div class="sidebar-user-detail">
                        <div class="sidebar-user-name">{{ Auth::user()->nama }}</div>
                        <div class="sidebar-user-role">
                            @foreach(Auth::user()->getRoleNames() as $role)
                                {{ $role }}
                            @endforeach
                        </div>
                    </div>
                </div>
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout-sidebar">
                    <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Overlay untuk mobile/tablet saat sidebar terbuka -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="main-content">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <button class="btn-sidebar-toggle" id="sidebarToggle" type="button" aria-label="Toggle sidebar">
                    <i class="fas fa-bars"></i>
                </button>

                @php $unreadCount = Auth::user()->unreadNotifications->count(); @endphp
                <div class="d-flex align-items-center ms-auto">
                    <div class="dropdown me-3 me-lg-4">
                        <a class="position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: var(--text); padding: 4px;">
                            <i class="fas fa-bell" style="font-size: 18px;"></i>
                            @if($unreadCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 9px; min-width: 18px; height: 18px; display: flex; align-items: center; justify-content: center;">
                                    {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                                </span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-end shadow" style="width: 380px; max-height: 460px; overflow-y: auto; border-radius: 12px; border: 1px solid var(--border); padding: 0;">
                            <div class="d-flex justify-content-between align-items-center px-4 py-3" style="border-bottom: 1px solid var(--border); background: #fafbfc;">
                                <span class="fw-bold" style="font-size: 14px; color: var(--text);">Notifikasi</span>
                                @if($unreadCount > 0)
                                    <form action="{{ route('notifications.read-all') }}" method="POST" class="m-0">
                                        @csrf @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-link text-decoration-none" style="font-size: 12px; color: var(--primary);">Tandai semua dibaca</button>
                                    </form>
                                @endif
                            </div>
                            @forelse(Auth::user()->unreadNotifications->take(10) as $notification)
                                <a href="{{ route('notifications.redirect', $notification) }}" class="dropdown-item px-4 py-3" style="border-bottom: 1px solid #f0f0f0; white-space: normal; {{ $loop->first ? 'background: var(--mint);' : '' }}">
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="mt-1">
                                            @if(\Illuminate\Support\Str::contains($notification->type, 'PengajuanBaru'))
                                                <i class="fas fa-file-alt" style="color: var(--info); font-size: 15px;"></i>
                                            @elseif(\Illuminate\Support\Str::contains($notification->type, 'PengajuanTerverifikasi'))
                                                <i class="fas fa-check-circle" style="color: #3498db; font-size: 15px;"></i>
                                            @elseif(\Illuminate\Support\Str::contains($notification->type, 'PengajuanDiverifikasi'))
                                                <i class="fas fa-check-double" style="color: #3498db; font-size: 15px;"></i>
                                            @elseif(\Illuminate\Support\Str::contains($notification->type, 'PengajuanDitolakOperator'))
                                                <i class="fas fa-undo" style="color: var(--warning, #f39c12); font-size: 15px;"></i>
                                            @elseif(\Illuminate\Support\Str::contains($notification->type, 'StatusPersetujuan'))
                                                @if(($notification->data['status'] ?? '') === 'disetujui')
                                                    <i class="fas fa-check-circle" style="color: var(--primary); font-size: 15px;"></i>
                                                @else
                                                    <i class="fas fa-times-circle" style="color: var(--danger); font-size: 15px;"></i>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="flex-grow-1" style="font-size: 13px;">
                                            <div style="color: var(--text); font-weight: 500; line-height: 1.4;">{{ $notification->data['message'] ?? '' }}</div>
                                            <small style="color: var(--muted);">{{ $notification->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="text-center py-5" style="color: var(--muted); font-size: 13px;">
                                    <i class="fas fa-bell-slash mb-2" style="font-size: 24px; display: block;"></i>
                                    Tidak ada notifikasi baru
                                </div>
                            @endforelse
                            <a href="{{ route('notifications.index') }}" class="dropdown-item text-center py-3" style="font-size: 13px; color: var(--primary); font-weight: 500; border-top: 1px solid var(--border); --bs-dropdown-link-hover-bg: transparent; --bs-dropdown-link-active-bg: transparent;">Lihat semua notifikasi</a>
                        </div>
                    </div>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a href="{{ route('profil') }}" class="text-decoration-none">
                                    <div class="user-info">
                                        <div class="text-end">
                                            <div class="user-name" style="color: var(--text);">{{ Auth::user()->nama }}</div>
                                            <div class="user-role">
                                                @foreach(Auth::user()->getRoleNames() as $role)
                                                    {{ $role }}
                                                @endforeach
                                            </div>
                                        </div>
                                        @if(Auth::user()->foto)
                                            <img src="{{ supabase_storage_url(Auth::user()->foto) }}" class="avatar-sm" style="margin-left: 10px;">
                                        @else
                                            <div class="avatar-sm bg-primary text-white d-flex align-items-center justify-content-center" style="margin-left: 10px;">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        @endif
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <section class="section">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </section>

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        <span>&copy; {{ date('Y') }} BKD Kepulauan Selayar</span>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        (function () {
            const sidebar = document.getElementById('mainSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const toggleBtn = document.getElementById('sidebarToggle');

            function openSidebar() {
                sidebar.classList.add('sidebar-open');
                overlay.classList.add('active');
            }

            function closeSidebar() {
                sidebar.classList.remove('sidebar-open');
                overlay.classList.remove('active');
            }

            toggleBtn.addEventListener('click', function () {
                if (sidebar.classList.contains('sidebar-open')) {
                    closeSidebar();
                } else {
                    openSidebar();
                }
            });

            overlay.addEventListener('click', closeSidebar);

            // Auto-close saat menu diklik (mobile/tablet)
            document.querySelectorAll('.sidebar-menu a').forEach(function (link) {
                link.addEventListener('click', function () {
                    if (window.innerWidth <= 991.98) {
                        closeSidebar();
                    }
                });
            });

            // Tutup otomatis saat resize kembali ke desktop
            window.addEventListener('resize', function () {
                if (window.innerWidth > 991.98) {
                    closeSidebar();
                }
            });
        })();
    </script>

    @stack('scripts')
</body>
</html>