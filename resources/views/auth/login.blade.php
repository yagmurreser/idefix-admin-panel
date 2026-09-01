<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İdefix Admin Panel</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }

        .login-card {
            width: 380px;
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .login-card h2 {
            text-align: center;
            margin-bottom: 30px;
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
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 7px;
            font-size: 15px;
        }

        input:focus {
            outline: none;
            border-color: #333;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 7px;
            background: #222;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #444;
        }

        .error {
            margin-bottom: 20px;
            padding: 10px;
            background: #ffe5e5;
            border-radius: 6px;
            color: #b00020;
        }
    </style>
</head>

<body>

<div class="login-card">

    <h2>İdefix Admin Girişi</h2>

    @if (session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.submit') }}">
        @csrf

        <div class="form-group">
            <label>Kullanıcı Adı</label>
            <input
                type="text"
                name="username"
                required
            >
        </div>

        <div class="form-group">
            <label>Şifre</label>
            <input
                type="password"
                name="password"
                required
            >
        </div>

        <button type="submit">
            Giriş Yap
        </button>

    </form>

</div>

</body>
</html>