<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Giriş</title>
</head>
<body>

    <h2>Admin Giriş</h2>

    <form method="POST" action="{{ route('login.submit') }}">
        @csrf
 
        <div>
            <label>Kullanıcı Adı</label><br>
            <input type="text" name="username">
        </div>

        <br>

        <div>
            <label>Şifre</label><br>
            <input type="password" name="password">
        </div>

        <br>

        <button type="submit">Giriş Yap</button>

    </form>

</body>
</html>