@extends('layouts.admin')

@section('content')

<h1 class="dashboard-title">
    Admin Panel
</h1>

<div class="dashboard-grid">

    <a
        href="{{ route('admin.users.index') }}"
        class="dashboard-card"
    >
        <h3>Admin Kullanıcı Yönetimi</h3>

        <p>
            Admin kullanıcılarını listeleyin,
            oluşturun, düzenleyin ve yönetin.
        </p>
    </a>

    <a
        href="{{ route('admin.categories.index') }}"
        class="dashboard-card"
    >
        <h3>Kategori Yönetimi</h3>

        <p>
            Ürün kategorilerini görüntüleyin
            ve kategori işlemlerini yönetin.
        </p>
    </a>

    <a
        href="{{ route('admin.products.index') }}"
        class="dashboard-card"
    >
        <h3>Ürün Yönetimi</h3>

        <p>
            Ürünleri listeleyin,
            oluşturun ve düzenleyin.
        </p>
    </a>

    <a
        href="{{ route('admin.orders.index') }}"
        class="dashboard-card"
    >
        <h3>Sipariş Yönetimi</h3>

        <p>
            Oluşturulan siparişleri görüntüleyin
            ve sipariş detaylarını inceleyin.
        </p>
    </a>

</div>

@endsection