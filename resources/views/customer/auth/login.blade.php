<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Müşteri Giriş</title>
</head>
<body>

    <h1>Müşteri Giriş</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('customer.login.submit') }}">
        @csrf

        <div>
            <label>Kullanıcı Adı</label>
            <input
                type="text"
                name="username"
                value="{{ old('username') }}"
                required
            >
        </div>

        <div>
            <label>Şifre</label>
            <input
                type="password"
                name="password"
                required
            >
        </div>

        <button type="submit">Giriş Yap</button>
    </form>

    <p>
        Hesabın yok mu?
        <a href="{{ route('customer.register') }}">Kayıt Ol</a>
    </p>

</body>
</html>