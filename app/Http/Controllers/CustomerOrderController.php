<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{
    public function show(
        Request $request,
        string $orderNumber
    ) {
        $order = Order::with([
            'items',
            'campaign',
        ])
            ->where('order_number', $orderNumber)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        return view(
            'customer.orders.show',
            compact('order')
        );
    }
}