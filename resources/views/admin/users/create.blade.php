<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kullanıcı Ekle</title>
</head>
<body>

<h1>
    
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

Yeni Kullanıcı Ekle</h1>

<form method="POST" action="{{ route('admin.users.store') }}">
    @csrf

    <label>Username</label>
    <input type="text" name="username">

    <br><br>

    <label>User Title</label>
    <input type="text" name="user_title">

    <br><br>

    <label>Password</label>
    <input type="password" name="password">

    <br><br>

    <button type="submit">
        Kaydet
    </button>

    <br><br>

    <a href="{{ route('admin.users.index') }}">
        Kullanıcı listesine dön
    </a>

</form>

</body>
</html>