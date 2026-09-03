<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepetim</title>
</head>
<body>

    <h1>Sepetim</h1>

    <a href="{{ route('customer.shop') }}">
        ← Alışverişe Devam Et
    </a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if (empty($cart))

        <p>Sepetiniz boş.</p>

    @else

        @php
            $subtotal = 0;
        @endphp

        @foreach ($cart as $item)

            @php
                $lineTotal = $item['unit_price'] * $item['quantity'];
                $subtotal += $lineTotal;
            @endphp

            <hr>

            <h3>{{ $item['product_title'] }}</h3>

            <p>
                Birim Fiyat:
                {{ number_format($item['unit_price'], 2) }} TL
            </p>

            <p>
                Adet:
                {{ $item['quantity'] }}
            </p>

            <p>
                Ürün Toplamı:
                {{ number_format($lineTotal, 2) }} TL
            </p>

            <form
                method="POST"
                action="{{ route('customer.cart.remove', $item['product_id']) }}"
            >
                @csrf
                @method('DELETE')

                <button type="submit">
                    Sepetten Çıkar
                </button>
            </form>

        @endforeach

        <hr>

        <h2>
            Ara Toplam:
            {{ number_format($subtotal, 2) }} TL
        </h2>
      <form method="POST" action="{{ route('customer.checkout.store') }}">
        @csrf

    <button type="submit">
        Siparişi Tamamla
    </button>
        </form>

    @endif 

    @if ($campaignResult['campaign'])
    <p>
        Uygulanan Kampanya:
        {{ $campaignResult['campaign']->name }}
    </p>

    <p>
        İndirim:
        {{ number_format($campaignResult['discount_amount'], 2) }} TL
    </p>
    @else
    <p>Uygun kampanya bulunamadı.</p>
    @endif

</body>
</html>