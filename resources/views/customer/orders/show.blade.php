<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipariş Detayı</title>
</head>
<body>

    <h1>Sipariş Detayı</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <p>
        <strong>Sipariş Numarası:</strong>
        {{ $order->order_number }}
    </p>

    <p>
        <strong>Sipariş Tarihi:</strong>
        {{ $order->created_at }}
    </p>

    <hr>

    <h2>Ürünler</h2>

    @foreach ($order->items as $item)

        <h3>{{ $item->product_title }}</h3>

        <p>
            Birim Fiyat:
            {{ number_format($item->unit_price, 2) }} TL
        </p>

        <p>
            Adet:
            {{ $item->quantity }}
        </p>

        <p>
            Ürün Toplamı:
            {{ number_format($item->line_total, 2) }} TL
        </p>

        <hr>

    @endforeach

    <h2>Finansal Bilgiler</h2>

    <p>
        <strong>İndirim Öncesi Tutar:</strong>
        {{ number_format($order->subtotal, 2) }} TL
    </p>

    <p>
        <strong>Uygulanan Kampanya:</strong>

        @if ($order->campaign)
            {{ $order->campaign->name }}
        @else
            Kampanya uygulanmadı
        @endif
    </p>

    <p>
        <strong>İndirim Tutarı:</strong>
        {{ number_format($order->discount_amount, 2) }} TL
    </p>

    <p>
        <strong>Kargo:</strong>
        {{ number_format($order->shipping_amount, 2) }} TL
    </p>

    <p>
        <strong>Ödenecek Tutar:</strong>
        {{ number_format($order->total_amount, 2) }} TL
    </p>

    <a href="{{ route('customer.shop') }}">
        Alışverişe Dön
    </a>

</body>
</html>