<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
</head>
<body>

<h1>Admin Panel</h1>

   @if (session('success'))
    <p>{{ session('success') }}</p>
   @endif


<nav>
    <a href="{{ route('admin.users.index') }}">
        Admin Users
    </a>

    <br><br>

    <span>Categories</span>

    <br><br>

    <span>Products</span>
</nav>

<br><br>

<form method="POST" action="{{ route('logout') }}">
    @csrf

    <button type="submit">
        Logout
    </button>
</form>

</body>
</html>