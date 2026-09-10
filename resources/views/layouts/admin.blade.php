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
            color: #222;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */

        .sidebar {
            width: 250px;
            background: #222;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
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
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: #444;
        }

        .sidebar a.active {
            background: #555;
        }

        /* LOGOUT */

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

        .logout-button:hover {
            background: #a91f1f;
        }

        /* CONTENT */

        .content {
            flex: 1;
            padding: 40px;
            min-width: 0;
        }

        .content-card {
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        /* PAGE HEADER */

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .page-header h1 {
            margin: 0;
        }

        /* BUTTONS */

        .button {
            display: inline-block;
            padding: 10px 16px;
            border: none;
            border-radius: 7px;
            background: #333;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        .button:hover {
            background: #444;
        }

        .button-secondary {
            background: #666;
        }

        .button-secondary:hover {
            background: #555;
        }

        /* TABLE */

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .admin-table th,
        .admin-table td {
            padding: 13px 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
            vertical-align: middle;
        }

        .admin-table th {
            background: #f1f1f1;
            font-weight: bold;
        }

        .admin-table tr:hover {
            background: #fafafa;
        }

        /* DASHBOARD */

        .dashboard-title {
            margin-top: 0;
            margin-bottom: 30px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .dashboard-card {
            display: block;
            padding: 30px 20px;
            border: 1px solid #ddd;
            border-radius: 12px;
            text-decoration: none;
            color: #222;
            background: white;
            transition: 0.2s;
        }

        .dashboard-card:hover {
            background: #f7f7f7;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .dashboard-card h3 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .dashboard-card p {
            margin-bottom: 0;
            color: #666;
        }

        /* ORDER DETAIL */

        .order-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .order-info-card {
            background: #f7f7f7;
            padding: 18px;
            border-radius: 8px;
        }

        .order-info-card strong {
            display: block;
            margin-bottom: 7px;
        }

        .order-summary {
            margin-top: 30px;
            max-width: 450px;
            margin-left: auto;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .summary-total {
            font-size: 20px;
            font-weight: bold;
        }

        @media (max-width: 800px) {
            .admin-wrapper {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .content {
                padding: 20px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .admin-table {
                font-size: 13px;
            }
        }
    </style>
</head>

<body>

    <div class="admin-wrapper">

        <aside class="sidebar">

            <h2>idefix Admin</h2>

            <a
                href="{{ route('dashboard') }}"
                class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"
            >
                Ana Sayfa
            </a>

            <a
                href="{{ route('admin.users.index') }}"
                class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
            >
                Kullanıcı Yönetimi
            </a>

            <a
                href="{{ route('admin.categories.index') }}"
                class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
            >
                Kategori Yönetimi
            </a>

            <a
                href="{{ route('admin.products.index') }}"
                class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}"
            >
                Ürün Yönetimi
            </a>

            <a
                href="{{ route('admin.orders.index') }}"
                class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}"
            >
                Sipariş Yönetimi
            </a>

            <form
                method="POST"
                action="{{ route('logout') }}"
                class="logout-form"
            >
                @csrf

                <button
                    type="submit"
                    class="logout-button"
                >
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