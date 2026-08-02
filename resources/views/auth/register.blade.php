<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Kenaikan Pangkat BKD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #12A150;
            --primary-dark: #0B5C33;
            --mint: #EAF7EF;
            --text: #34395E;
            --border: #E4E6EF;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            background: #FAFBFC;
            color: var(--text);
            font-family: 'Poppins', 'Calibri', sans-serif;
            font-size: 11pt;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 16px;
        }

        .credential-wrap {
            width: 100%;
            max-width: 520px;
        }

        .brand-mark {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 28px;
        }
        .brand-mark .icon-badge {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--mint);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .brand-mark .icon-badge i {
            color: var(--primary-dark);
            font-size: 17px;
        }
        .brand-mark span {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 15pt;
            color: var(--text);
        }

        .card-official {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: 0 12px 32px rgba(52,57,94,0.06);
            padding: 40px 36px;
        }

        .card-official h3 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 16pt;
            color: var(--text);
            margin-bottom: 6px;
            text-align: center;
        }
        .card-official .subtitle {
            color: #9095ac;
            font-size: 10pt;
            margin-bottom: 32px;
            text-align: center;
        }

        .form-group-official { margin-bottom: 20px; }

        .form-label {
            font-weight: 600;
            font-size: 9pt;
            color: var(--text);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .input-group-text {
            background: #fff;
            border-color: var(--border);
            color: #9aa0bc;
        }

        .form-control {
            border-color: var(--border);
            padding: 10px 12px;
            font-size: 11pt;
        }
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(18,161,80,0.15);
        }

        .btn-register {
            background: var(--primary);
            border: none;
            color: #fff;
            padding: 12px;
            font-weight: 600;
            font-size: 11pt;
            width: 100%;
            border-radius: 8px;
            margin-top: 8px;
            transition: background 0.15s ease;
        }
        .btn-register:hover { background: var(--primary-dark); color: #fff; }

        .alert-danger {
            background: #fdecec;
            border: 1px solid #f5c6c6;
            color: #c0392b;
            font-size: 10pt;
            border-radius: 8px;
        }
        .alert-danger ul { padding-left: 18px; }

        .card-footer-official {
            text-align: center;
            margin-top: 26px;
            font-size: 10pt;
            color: #9095ac;
        }
        .card-footer-official a { color: var(--primary-dark); text-decoration: none; font-weight: 600; }
        .card-footer-official a:hover { text-decoration: underline; }

        .bottom-note {
            text-align: center;
            font-size: 8.5pt;
            color: #b2b6c9;
            margin-top: 24px;
        }
    </style>
</head>
<body>
    <div class="credential-wrap">
        <div class="brand-mark">
            <div class="icon-badge"><i class="fas fa-award"></i></div>
            <span>SIPAK</span>
        </div>

        <div class="card-official">
            <h3>Daftar Akun</h3>
            <p class="subtitle">Portal Kenaikan Pangkat &mdash; Badan Kepegawaian Daerah</p>

            @if($errors->any())
                <div class="alert alert-danger py-2">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group-official">
                            <label class="form-label">NIP</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                <input type="text" name="nip" class="form-control" value="{{ old('nip') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group-official">
                            <label class="form-label">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group-official">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-official">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-official">
                            <label class="form-label">Konfirmasi Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-register">
                    <i class="fas fa-user-plus me-2"></i>Daftar
                </button>
            </form>

            <div class="card-footer-official">
                Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
            </div>
        </div>

        <div class="bottom-note">&copy; {{ date('Y') }} BKD Kepulauan Selayar</div>
    </div>
</body>
</html>