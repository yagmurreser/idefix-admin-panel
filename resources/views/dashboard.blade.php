<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Admin Paneli</title>
</head>
<body>

<h1>Admin Paneli</h1>

<p>Hoş geldiniz.</p>

<a href="{{ route('admin.users.index') }}">
    Admin Kullanıcıları
</a>

<br><br>

<form method="POST" action="{{ route('logout') }}">
    @csrf

    <button type="submit">
        Çıkış Yap
    </button>
</form>

</body>
</html>