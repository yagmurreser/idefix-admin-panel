<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'idefix')</title>

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

        .customer-header {
            background: #222;
            color: white;
        }

        .header-top {
            max-width: 1200px;
            margin: 0 auto;
            padding: 22px 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .brand {
            font-size: 28px;
            font-weight: bold;
            text-decoration: none;
            color: white;
        }

        .welcome {
            color: #ddd;
        }

        .customer-nav {
            background: #333;
        }

        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 25px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link {
            display: inline-block;
            color: white;
            text-decoration: none;
            padding: 15px 18px;
        }

        .nav-link:hover,
        .nav-link.active {
            background: #555;
        }

        .logout-form {
            margin-left: auto;
        }

        .logout-button {
            border: none;
            background: #c62828;
            color: white;
            padding: 10px 16px;
            border-radius: 7px;
            cursor: pointer;
        }

        .logout-button:hover {
            background: #a91f1f;
        }

        .page-container {
            max-width: 1200px;
            margin: 35px auto;
            padding: 0 25px;
        }

        .content-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
        }

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

        .button {
            display: inline-block;
            border: none;
            border-radius: 7px;
            background: #222;
            color: white;
            padding: 11px 16px;
            text-decoration: none;
            cursor: pointer;
        }

        .button:hover {
            background: #333;
        }

        .button-danger {
            background: #c62828;
        }

        .button-danger:hover {
            background: #a91f1f;
        }

        .success-box {
            background: #e7f7eb;
            color: #216b34;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .error-box {
            background: #fdecec;
            color: #9f1d1d;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .error-box ul {
            margin: 0;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
        }

        .product-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            background: white;
        }

        .product-card h3 {
            margin-top: 0;
        }

        .product-info {
            color: #555;
            line-height: 1.6;
        }

        .price {
            font-size: 20px;
            font-weight: bold;
            margin: 15px 0;
        }

        .stock {
            font-size: 14px;
            color: #666;
        }

        .add-form {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .quantity-input {
            width: 75px;
            padding: 9px;
            border: 1px solid #ccc;
            border-radius: 7px;
        }

        .cart-item {
            padding: 20px 0;
            border-bottom: 1px solid #ddd;
        }

        .cart-item h3 {
            margin-top: 0;
        }

        .summary {
            max-width: 500px;
            margin-left: auto;
            margin-top: 30px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 11px 0;
            border-bottom: 1px solid #ddd;
        }

        .summary-total {
            font-size: 21px;
            font-weight: bold;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }

        .admin-table th,
        .admin-table td {
            padding: 13px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        .admin-table th {
            background: #f1f1f1;
        }

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

        @media (max-width: 700px) {
            .header-top,
            .nav-inner,
            .page-header {
                flex-direction: column;
                align-items: stretch;
            }

            .logout-form {
                margin-left: 0;
            }

            .logout-button {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<header class="customer-header">

    <div class="header-top">

        <a
            href="{{ route('customer.shop') }}"
            class="brand"
        >
            idefix
        </a>

        <div class="welcome">
            Hoş geldin,
            <strong>{{ auth()->user()->user_title }}</strong>
        </div>

    </div>

    <nav class="customer-nav">

        <div class="nav-inner">

            <a
                href="{{ route('customer.shop') }}"
                class="nav-link {{ request()->routeIs('customer.shop') ? 'active' : '' }}"
            >
                Ürünler
            </a>

            <a
                href="{{ route('customer.cart.index') }}"
                class="nav-link {{ request()->routeIs('customer.cart.*') ? 'active' : '' }}"
            >
                Sepetim
            </a>

            <a
                href="{{ route('customer.orders.index') }}"
                class="nav-link {{ request()->routeIs('customer.orders.*') ? 'active' : '' }}"
            >
                Siparişlerim
            </a>

            <form
                method="POST"
                action="{{ route('customer.logout') }}"
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

        </div>

    </nav>

</header>


<main class="page-container">

    <div class="content-card">

        @if (session('success'))

            <div class="success-box">
                {{ session('success') }}
            </div>

        @endif

        @if ($errors->any())

            <div class="error-box">

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>

        @endif

        @yield('content')

    </div>

</main>

</body>
</html>