<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>

    <h1>Admin Paneli</h1>

    <p>Hoş geldiniz.</p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Çıkış Yap</button>
    </form>

</body>
</html>