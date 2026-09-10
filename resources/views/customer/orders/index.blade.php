@extends('layouts.customer')

@section('title', 'Siparişlerim')

@section('content')

<div class="page-header">

    <h1>Siparişlerim</h1>

    <a
        href="{{ route('customer.shop') }}"
        class="button"
    >
        Alışverişe Devam Et
    </a>

</div>


@if ($orders->isEmpty())

    <p>
        Henüz bir siparişiniz bulunmamaktadır.
    </p>

@else

    <table class="admin-table">

        <thead>

            <tr>
                <th>Sipariş No</th>
                <th>Tarih</th>
                <th>Kampanya</th>
                <th>Ara Toplam</th>
                <th>İndirim</th>
                <th>Toplam</th>
                <th>İşlem</th>
            </tr>

        </thead>

        <tbody>

            @foreach ($orders as $order)

                <tr>

                    <td>
                        {{ $order->order_number }}
                    </td>

                    <td>
                        {{ $order->created_at?->format('d.m.Y H:i') }}
                    </td>

                    <td>
                        {{ $order->campaign?->name ?? 'Kampanya yok' }}
                    </td>

                    <td>
                        {{ number_format($order->subtotal, 2) }} TL
                    </td>

                    <td>
                        {{ number_format($order->discount_amount, 2) }} TL
                    </td>

                    <td>
                        <strong>
                            {{ number_format($order->total_amount, 2) }} TL
                        </strong>
                    </td>

                    <td>

                        <a
                            href="{{ route(
                                'customer.orders.show',
                                $order->order_number
                            ) }}"
                            class="button"
                        >
                            Detay
                        </a>

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

@endif

@endsection