@extends('layouts.admin')

@section('content')

<div class="page-header">

    <h1>Sipariş Yönetimi</h1>

</div>

@if ($orders->isEmpty())

    <p>Henüz oluşturulmuş bir sipariş bulunmamaktadır.</p>

@else

    <table class="admin-table">

        <thead>
            <tr>
                <th>Sipariş No</th>
                <th>Müşteri</th>
                <th>Kampanya</th>
                <th>Ara Toplam</th>
                <th>İndirim</th>
                <th>Kargo</th>
                <th>Toplam</th>
                <th>Tarih</th>
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
                        {{ $order->user?->user_title ?? 'Kullanıcı bulunamadı' }}
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

                        @if ($order->shipping_amount == 0)

                            Ücretsiz

                        @else

                            {{ number_format($order->shipping_amount, 2) }} TL

                        @endif

                    </td>

                    <td>
                        <strong>
                            {{ number_format($order->total_amount, 2) }} TL
                        </strong>
                    </td>

                    <td>
                        {{ $order->created_at?->format('d.m.Y H:i') }}
                    </td>

                    <td>

                        <a
                            href="{{ route('admin.orders.show', $order) }}"
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