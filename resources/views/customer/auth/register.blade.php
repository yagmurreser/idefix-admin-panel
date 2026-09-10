<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Müşteri Kayıt</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-card {
            width: 100%;
            max-width: 460px;
            background: white;
            padding: 35px;
            border-radius: 14px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        .brand {
            text-align: center;
            margin-bottom: 30px;
        }

        .brand h1 {
            margin: 0 0 8px;
        }

        .brand p {
            margin: 0;
            color: #666;
        }

        .error-box {
            background: #fdecec;
            color: #9f1d1d;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .error-box ul {
            margin: 0;
            padding-left: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }

        input:focus {
            outline: none;
            border-color: #555;
        }

        .submit-button {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 8px;
            background: #222;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .submit-button:hover {
            background: #333;
        }

        .login-link {
            text-align: center;
            margin-top: 22px;
            color: #666;
        }

        .login-link a {
            color: #222;
            font-weight: bold;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="auth-card">

    <div class="brand">
        <h1>idefix</h1>
        <p>Müşteri Kaydı</p>
    </div>

    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        method="POST"
        action="{{ route('customer.register.submit') }}"
    >
        @csrf

        <div class="form-group">
            <label for="username">
                Kullanıcı Adı
            </label>

            <input
                id="username"
                type="text"
                name="username"
                value="{{ old('username') }}"
                required
            >
        </div>

        <div class="form-group">
            <label for="user_title">
                Ad Soyad
            </label>

            <input
                id="user_title"
                type="text"
                name="user_title"
                value="{{ old('user_title') }}"
                required
            >
        </div>

        <div class="form-group">
            <label for="password">
                Şifre
            </label>

            <input
                id="password"
                type="password"
                name="password"
                required
            >
        </div>

        <div class="form-group">
            <label for="password_confirmation">
                Şifre Tekrar
            </label>

            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
            >
        </div>

        <button
            type="submit"
            class="submit-button"
        >
            Kayıt Ol
        </button>
    </form>

    <div class="login-link">
        Zaten hesabınız var mı?
        <a href="{{ route('login') }}">
            Giriş Yap
        </a>
    </div>

</div>

</body>
</html>