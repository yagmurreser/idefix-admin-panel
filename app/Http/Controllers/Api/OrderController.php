<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use RuntimeException;

class OrderController extends Controller
{
    public function store(
        Request $request,
        OrderService $orderService
    ): JsonResponse {
        $validated = $request->validate([
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'integer', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
        ]);

        /** @var User $user */
        $user = $request->user();

        $cart = [];

        foreach ($validated['items'] as $item) {
            $cart[$item['product_id']] = [
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
            ];
        }

        try {
            $order = $orderService->create(
                $user,
                $cart
            );
        } catch (RuntimeException $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 422);
        }

        return response()->json([
            'message' => 'Sipariş başarıyla oluşturuldu.',
            'data' => [
                'order_number' => $order->order_number,
                'subtotal' => $order->subtotal,
                'campaign' => $order->campaign?->name,
                'discount_amount' => $order->discount_amount,
                'shipping_amount' => $order->shipping_amount,
                'total_amount' => $order->total_amount,
            ],
        ], 201);
    }

    public function show(
        Request $request,
        string $orderNumber
    ): JsonResponse {
        $order = Order::with([
            'items',
            'campaign',
        ])
            ->where('order_number', $orderNumber)
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$order) {
            return response()->json([
                'message' => 'Sipariş bulunamadı.',
            ], 404);
        }

        return response()->json([
            'data' => [
                'order_number' => $order->order_number,
                'created_at' => $order->created_at,
                'items' => $order->items->map(function ($item) {
                    return [
                        'product_id' => $item->product_id,
                        'product_title' => $item->product_title,
                        'unit_price' => $item->unit_price,
                        'quantity' => $item->quantity,
                        'line_total' => $item->line_total,
                    ];
                }),
                'subtotal' => $order->subtotal,
                'campaign' => $order->campaign?->name,
                'discount_amount' => $order->discount_amount,
                'shipping_amount' => $order->shipping_amount,
                'total_amount' => $order->total_amount,
            ],
        ]);
    }
}