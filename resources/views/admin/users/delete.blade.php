<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kullanıcı Sil</title>
</head>
<body>

<h1>Kullanıcı Sil</h1>

<p>Bu kullanıcıyı silmek istediğinize emin misiniz?</p>

<p>
    <strong>Username:</strong> {{ $user->username }}
</p>

<p>
    <strong>User Title:</strong> {{ $user->user_title }}
</p>

<form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
    @csrf
    @method('DELETE')

    <button type="submit">
        Sil
    </button>
</form>

<br>

<a href="{{ route('admin.users.index') }}">
    Vazgeç
</a>

</body>
</html>