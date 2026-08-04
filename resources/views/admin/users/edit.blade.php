<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kullanıcı Düzenle</title>
</head>
<body>

<h1>Kullanıcı Düzenle</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('admin.users.update', $user->id) }}">
    @csrf
    @method('PUT')

    <label>Username</label>
    <br>
    <input
        type="text"
        name="username"
        value="{{ old('username', $user->username) }}"
    >
    <br><br>

    <label>User Title</label>
    <br>
    <input
        type="text"
        name="user_title"
        value="{{ old('user_title', $user->user_title) }}"
    >
    <br><br>

    <label>Şifre</label>
    <br>
    <input type="password" name="password">

    <br><br>

    <button type="submit">
        Güncelle
    </button>
</form>

</body>
</html>