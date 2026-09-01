<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>idefix Admin Panel</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #222;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
        }

        .sidebar h2 {
            color: white;
            margin-top: 0;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 13px 15px;
            margin-bottom: 10px;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 7px;
        }

        .sidebar a:hover {
            background: #444;
        }

        .logout-form {
            margin-top: auto;
        }

        .logout-button {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 7px;
            background: #c62828;
            color: white;
            cursor: pointer;
            font-size: 15px;
        }

        .content {
            flex: 1;
            padding: 40px;
        }

        .content-card {
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>

<body>

<div class="admin-wrapper">

    <aside class="sidebar">

        <h2>idefix Admin</h2>

        <a href="{{ route('admin.users.index') }}">
            Admin Kullanıcı Yönetimi
        </a>

        <a href="{{ route('admin.categories.index') }}">
            Kategori Yönetimi
        </a>

        <a href="{{ route('admin.products.index') }}">
            Ürün Yönetimi
        </a>

        <form
            method="POST"
            action="{{ route('logout') }}"
            class="logout-form"
        >
            @csrf

            <button type="submit" class="logout-button">
                Çıkış Yap
            </button>
        </form>

    </aside>

    <main class="content">
        <div class="content-card">
            @yield('content')
        </div>
    </main>

</div>

</body>
</html>