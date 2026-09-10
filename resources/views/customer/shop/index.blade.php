@extends('layouts.customer')

@section('title', 'Ürünler')

@section('content')

<div class="page-header">

    <h1>Ürünler</h1>

    <a
        href="{{ route('customer.cart.index') }}"
        class="button"
    >
        Sepetime Git
    </a>

</div>


<div class="product-grid">

    @foreach ($products as $product)

        <div class="product-card">

            <h3>
                {{ $product->product_title }}
            </h3>

            <div class="product-info">

                <p>
                    <strong>Kategori:</strong>
                    {{ $product->category?->category_title ?? 'Kategori yok' }}
                </p>

                <p>
                    <strong>Yazar:</strong>
                    {{ $product->author?->author_name ?? 'Yazar yok' }}
                </p>

            </div>

            <div class="price">
                {{ number_format($product->list_price, 2) }} TL
            </div>

            <div class="stock">
                Stok: {{ $product->stock_quantity }}
            </div>


            @if ($product->stock_quantity > 0)

                <form
                    method="POST"
                    action="{{ route('customer.cart.add', $product) }}"
                    class="add-form"
                >
                    @csrf

                    <input
                        type="number"
                        name="quantity"
                        value="1"
                        min="1"
                        max="{{ $product->stock_quantity }}"
                        class="quantity-input"
                        required
                    >

                    <button
                        type="submit"
                        class="button"
                    >
                        Sepete Ekle
                    </button>

                </form>

            @else

                <p>
                    <strong>Stokta yok</strong>
                </p>

            @endif

        </div>

    @endforeach

</div>

@endsection