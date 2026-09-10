@extends('layouts.customer')

@section('title', 'Sepetim')

@section('content')

<div class="page-header">

    <h1>Sepetim</h1>

    <a
        href="{{ route('customer.shop') }}"
        class="button"
    >
        Alışverişe Devam Et
    </a>

</div>


@if (empty($cart))

    <p>Sepetiniz boş.</p>

@else

    @foreach ($cart as $item)

        <div class="cart-item">

            <h3>
                {{ $item['product_title'] }}
            </h3>

            <p>
                <strong>Birim Fiyat:</strong>
                {{ number_format($item['unit_price'], 2) }} TL
            </p>

            <p>
                <strong>Adet:</strong>
                {{ $item['quantity'] }}
            </p>

            <p>
                <strong>Ürün Toplamı:</strong>

                {{
                    number_format(
                        $item['unit_price'] * $item['quantity'],
                        2
                    )
                }} TL
            </p>

            <form
                method="POST"
                action="{{ route(
                    'customer.cart.remove',
                    $item['product_id']
                ) }}"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="button button-danger"
                >
                    Sepetten Çıkar
                </button>

            </form>

        </div>

    @endforeach


    <div class="summary">

        <div class="summary-row">

            <span>Ara Toplam</span>

            <strong>
                {{ number_format($subtotal, 2) }} TL
            </strong>

        </div>


        <div class="summary-row">

            <span>Uygulanan Kampanya</span>

            <strong>

                @if ($campaignResult['campaign'])

                    {{ $campaignResult['campaign']->name }}

                @else

                    Kampanya yok

                @endif

            </strong>

        </div>


        <div class="summary-row">

            <span>İndirim</span>

            <strong>
                {{ number_format($discountAmount, 2) }} TL
            </strong>

        </div>


        <div class="summary-row">

            <span>Kargo</span>

            <strong>

                @if ($shippingAmount == 0)

                    Ücretsiz

                @else

                    {{ number_format($shippingAmount, 2) }} TL

                @endif

            </strong>

        </div>


        <div class="summary-row summary-total">

            <span>Ödenecek Tutar</span>

            <span>
                {{ number_format($totalAmount, 2) }} TL
            </span>

        </div>


        <form
            method="POST"
            action="{{ route('customer.checkout.store') }}"
            style="margin-top: 20px;"
        >
            @csrf

            <button
                type="submit"
                class="button"
                style="width: 100%;"
            >
                Siparişi Tamamla
            </button>

        </form>

    </div>

@endif

@endsection