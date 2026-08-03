<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
</head>
<body>

<h1>Edit User</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.users.update', $user->id) }}">
    @csrf
    @method('PUT')

    <label for="username">Username</label>
    <input
        type="text"
        id="username"
        name="username"
        value="{{ old('username', $user->username) }}"
    >

    <br><br>

    <label for="user_title">User Title</label>
    <input
        type="text"
        id="user_title"
        name="user_title"
        value="{{ old('user_title', $user->user_title) }}"
    >

    <br><br>

    <label for="password">Password</label>
    <input
        type="password"
        id="password"
        name="password"
    >

    <br><br>

    <button type="submit">Update</button>

    <a href="{{ route('admin.users.index') }}">
        Back
    </a>
</form>

</body>
</html>