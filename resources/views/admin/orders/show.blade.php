@extends('layouts.admin')

@section('content')

<div class="page-header">

    <h1>Sipariş Detayı</h1>

    <a
        href="{{ route('admin.orders.index') }}"
        class="button button-secondary"
    >
        Siparişlere Dön
    </a>

</div>


<div class="order-info">

    <div class="order-info-card">

        <strong>Sipariş Numarası</strong>

        {{ $order->order_number }}

    </div>


    <div class="order-info-card">

        <strong>Müşteri</strong>

        {{ $order->user?->user_title ?? 'Kullanıcı bulunamadı' }}

    </div>


    <div class="order-info-card">

        <strong>Kullanıcı Adı</strong>

        {{ $order->user?->username ?? '-' }}

    </div>


    <div class="order-info-card">

        <strong>Sipariş Tarihi</strong>

        {{ $order->created_at?->format('d.m.Y H:i') }}

    </div>

</div>


<h2>Sipariş Ürünleri</h2>

<table class="admin-table">

    <thead>

        <tr>
            <th>Ürün</th>
            <th>Birim Fiyat</th>
            <th>Adet</th>
            <th>Ürün Toplamı</th>
        </tr>

    </thead>

    <tbody>

        @foreach ($order->items as $item)

            <tr>

                <td>
                    {{ $item->product_title }}
                </td>

                <td>
                    {{ number_format($item->unit_price, 2) }} TL
                </td>

                <td>
                    {{ $item->quantity }}
                </td>

                <td>
                    {{ number_format($item->line_total, 2) }} TL
                </td>

            </tr>

        @endforeach

    </tbody>

</table>


<div class="order-summary">

    <div class="summary-row">

        <span>Ara Toplam</span>

        <strong>
            {{ number_format($order->subtotal, 2) }} TL
        </strong>

    </div>


    <div class="summary-row">

        <span>Uygulanan Kampanya</span>

        <strong>
            {{ $order->campaign?->name ?? 'Kampanya uygulanmadı' }}
        </strong>

    </div>


    <div class="summary-row">

        <span>İndirim</span>

        <strong>
            {{ number_format($order->discount_amount, 2) }} TL
        </strong>

    </div>


    <div class="summary-row">

        <span>Kargo</span>

        <strong>

            @if ($order->shipping_amount == 0)

                Ücretsiz

            @else

                {{ number_format($order->shipping_amount, 2) }} TL

            @endif

        </strong>

    </div>


    <div class="summary-row summary-total">

        <span>Ödenecek Tutar</span>

        <span>
            {{ number_format($order->total_amount, 2) }} TL
        </span>

    </div>

</div>

@endsection