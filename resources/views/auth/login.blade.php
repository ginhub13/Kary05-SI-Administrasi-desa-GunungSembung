<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SID Gunung Sembung</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        :root {
            --primary: #115E59;
            --primary-hover: #0F766E;
            --bg-color: #F8FAFC;
            --text-main: #1E293B;
            --text-muted: #64748B;
            --border-color: #E2E8F0;
            --white: #FFFFFF;
            --danger: #EF4444;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(rgba(17, 94, 89, 0.8), rgba(17, 94, 89, 0.8)), url('/images/bg-sawah.jpg') center/cover no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-card {
            background-color: var(--white);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h1 {
            margin: 0;
            color: var(--primary);
            font-size: 24px;
            font-weight: 700;
        }

        .login-header p {
            margin: 5px 0 0 0;
            color: var(--text-muted);
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
            color: var(--text-main);
        }

        .form-group input[type="email"],
        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-family: inherit;
            font-size: 14px;
            box-sizing: border-box;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.2);
        }

        .form-group input.is-invalid {
            border-color: var(--danger);
        }

        .error-message {
            color: var(--danger);
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 13px;
        }

        .form-options label {
            display: flex;
            align-items: center;
            gap: 5px;
            color: var(--text-muted);
            cursor: pointer;
        }

        .form-options a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .btn-submit {
            width: 100%;
            background-color: var(--primary);
            color: var(--white);
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-family: inherit;
        }

        .btn-submit:hover {
            background-color: var(--primary-hover);
        }

        .footer-text {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: var(--text-muted);
        }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="login-header">
            <h1>SID Gunung Sembung</h1>
            <p>Silakan masuk ke panel admin</p>
        </div>

        <form method="POST" action="/login">
            @csrf

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="admin@gunungsembung.desa.id" class="@error('email') is-invalid @enderror" required autofocus>

                @error('email')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <div style="position: relative;">
                    <input type="password" name="password" id="password" placeholder="••••••••" class="@error('password') is-invalid @enderror" required style="padding-right: 40px;">
                    <span id="togglePassword" style="position:absolute; right:12px; top:50%; transform:translateY(-50%); cursor:pointer; font-size:14px; color:#64748B;">
                        <i id="passwordIcon" class="fa fa-eye"></i>
                    </span>
                </div>

                @error('password')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-options">
                <label>
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Ingat saya
                </label>

                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Lupa sandi?</a>
                @endif
            </div>

            <button type="submit" class="btn-submit">Masuk ke Dashboard</button>
        </form>

        <div class="footer-text">
            &copy; {{ date('Y') }} Pemerintah Desa Gunung Sembung
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const togglePassword = document.getElementById('togglePassword');

            togglePassword.addEventListener('click', function() {
                const isPassword = passwordInput.type === 'password';
                passwordInput.type = isPassword ? 'text' : 'password';
                togglePassword.innerHTML = isPassword ? '<i class="fa fa-eye-slash"></i>' : '<i class="fa fa-eye"></i>';
            });
        });
    </script>

</body>

</html>