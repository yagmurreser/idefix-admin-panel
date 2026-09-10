<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CustomerOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('campaign')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view(
            'customer.orders.index',
            compact('orders')
        );
    }

    public function show(string $orderNumber)
    {
        $order = Order::with([
            'items',
            'campaign',
        ])
            ->where('user_id', Auth::id())
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        return view(
            'customer.orders.show',
            compact('order')
        );
    }
}