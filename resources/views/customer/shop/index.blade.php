<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Mağaza</title>
</head>
<body>

    <h1>Mağaza</h1>

    <a href="{{ route('customer.cart.index') }}">
    Sepetim
    </a>

    @foreach ($products as $product)
        <div>
            <h3>{{ $product->product_title }}</h3>

            <p>
                Kategori:
                {{ $product->category?->category_title ?? 'Kategori yok' }}
            </p>

            <p>
                Yazar:
                {{ $product->author?->author_name ?? 'Yazar yok' }}
            </p>

            <p>
                Fiyat:
                {{ number_format($product->list_price, 2) }} TL
            </p>

            <p>
                Stok:
                {{ $product->stock_quantity }}
            </p>


            @if ($product->stock_quantity > 0)
     <form method="POST" action="{{ route('customer.cart.add', $product) }}">
            @csrf

        <input
            type="number"
            name="quantity"
            value="1"
            min="1"
            max="{{ $product->stock_quantity }}"
        >

        <button type="submit">
            Sepete Ekle
        </button>
    </form>
    @else
    <p>Stokta yok</p>
    @endif

            <hr>
        </div>
    @endforeach

</body>
</html>