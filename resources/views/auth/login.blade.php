<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Kenaikan Pangkat BKD</title>
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
            max-width: 400px;
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
            color: #616471;
            font-size: 10pt;
            margin-top: 15px;
            margin-bottom: 25px;
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

        /* ===== Role selector (pill toggle) ===== */
        .role-selector {
            display: flex;
            gap: 8px;
            background: #F4F6F9;
            padding: 5px;
            border-radius: 10px;
            border: 1px solid var(--border);
        }

        .role-selector input[type="radio"] {
            display: none;
        }

        .role-selector label {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            padding: 10px 6px;
            border-radius: 8px;
            cursor: pointer;
            color: #9095ac;
            font-size: 8.5pt;
            font-weight: 600;
            text-align: center;
            transition: all 0.15s ease;
            user-select: none;
        }

        .role-selector label i {
            font-size: 15px;
        }

        .role-selector label:hover {
            color: var(--primary-dark);
        }

        .role-selector input[type="radio"]:checked + label {
            background: #fff;
            color: var(--primary-dark);
            box-shadow: 0 2px 8px rgba(52,57,94,0.08);
        }

        .toggle-password { cursor: pointer; }
        .toggle-password:hover { background-color: var(--mint); }

        .btn-login {
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
        .btn-login:hover { background: var(--primary-dark); color: #fff; }

        .alert-danger {
            background: #fdecec;
            border: 1px solid #f5c6c6;
            color: #c0392b;
            font-size: 10pt;
            border-radius: 8px;
        }

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
            <h3>Masuk ke Akun Anda</h3>
            <p class="subtitle">Sistem Informasi Kenaikan Pangkat Pegawai</p>

            @if($errors->any())
                <div class="alert alert-danger py-2">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group-official">
                    <label class="form-label">Masuk sebagai</label>
                    <div class="role-selector">
                        <input type="radio" name="role" id="role-pegawai" value="Pegawai" {{ old('role', 'Pegawai') == 'Pegawai' ? 'checked' : '' }}>
                        <label for="role-pegawai">
                            <i class="fas fa-user"></i>
                            Pegawai
                        </label>

                        <input type="radio" name="role" id="role-admin" value="Admin BKD" {{ old('role') == 'Admin BKD' ? 'checked' : '' }}>
                        <label for="role-admin">
                            <i class="fas fa-user-shield"></i>
                            Admin BKD
                        </label>

                        <input type="radio" name="role" id="role-pimpinan" value="Pimpinan" {{ old('role') == 'Pimpinan' ? 'checked' : '' }}>
                        <label for="role-pimpinan">
                            <i class="fas fa-user-tie"></i>
                            Pimpinan
                        </label>
                    </div>
                </div>

                <div class="form-group-official">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>
                <div class="form-group-official">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" id="password" class="form-control" required>
                        <span class="input-group-text toggle-password" id="togglePassword">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </span>
                    </div>
                </div>
                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>Masuk
                </button>
            </form>

            <div class="card-footer-official">
                Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
            </div>
        </div>

        <div class="bottom-note">&copy; {{ date('Y') }} BKD Kepulauan Selayar</div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        });
    </script>
</body>
</html>