<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Müşteri Kayıt</title>
</head>
<body>

    <h1>Müşteri Kayıt</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('customer.register.submit') }}">
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
            <label>Ad Soyad</label>
            <input
                type="text"
                name="user_title"
                value="{{ old('user_title') }}"
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

        <div>
            <label>Şifre Tekrar</label>
            <input
                type="password"
                name="password_confirmation"
                required
            >
        </div>

        <button type="submit">Kayıt Ol</button>
    </form>

    <p>
        Zaten hesabın var mı?
        <a href="{{ route('customer.login') }}">Giriş Yap</a>
    </p>

</body>
</html>