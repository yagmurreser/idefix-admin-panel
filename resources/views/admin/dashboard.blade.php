<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>idefix Admin Panel</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        .container {
            width: 500px;
            margin: 100px auto;
            text-align: center;
        }

        h1 {
            margin-bottom: 40px;
        }

        .menu-item {
            display: block;
            width: 100%;
            box-sizing: border-box;
            padding: 20px;
            margin-bottom: 20px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            text-decoration: none;
            color: black;
            font-size: 20px;
        }

        .menu-item:hover {
            background: #eeeeee;
        }

        .logout-form {
            margin-top: 30px;
        }

        .logout-button {
            width: 100%;
            padding: 17px;
            background: #c62828;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            cursor: pointer;
        }

        .logout-button:hover {
            background: #a91f1f;
        }
    </style>

</head>

<body>

    <div class="container">

        <h1>Admin Panel</h1>

        <a class="menu-item" href="{{ route('admin.users.index') }}">
            Admin Kullanıcı Yönetimi
        </a>

        <a class="menu-item" href="{{ route('admin.categories.index') }}">
            Kategori Yönetimi
        </a>

        <a class="menu-item" href="{{ route('admin.products.index') }}">
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

    </div>

</body>

</html>