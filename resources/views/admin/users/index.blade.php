<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kullanıcı Listesi</title>
</head>
<body>

<h1>Admin Kullanıcıları</h1>

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

<a href="{{ route('admin.users.create') }}">
    Yeni kullanıcı ekle
</a>

<hr>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>User Title</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->user_title }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>