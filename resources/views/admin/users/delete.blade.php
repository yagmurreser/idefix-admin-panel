<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Delete User</title>
</head>
<body>

<h1>Delete User</h1>

<p>
    {{ $user->username }} kullanıcısını silmek istediğinize emin misiniz?
</p>

<form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
    @csrf
    @method('DELETE')

    <button type="submit">
        Delete
    </button>
</form>

<br>

<a href="{{ route('admin.users.index') }}">
    Back
</a>

</body>
</html>