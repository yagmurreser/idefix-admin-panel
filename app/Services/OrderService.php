<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class OrderService
{
    public function __construct(
        private CampaignEvaluator $campaignEvaluator
    ) {
    }

    public function create(User $user, array $cart): Order
    {
        return DB::transaction(function () use ($user, $cart) {

            if (empty($cart)) {
                throw new RuntimeException('Sepet boş.');
            }

            $items = collect();
            $subtotal = 0;

            foreach ($cart as $cartItem) {

                $product = Product::query()
                    ->lockForUpdate()
                    ->find($cartItem['product_id']);

                if (!$product) {
                    throw new RuntimeException('Ürün bulunamadı.');
                }

                $quantity = (int) $cartItem['quantity'];

                if ($quantity < 1) {
                    throw new RuntimeException(
                        'Ürün adedi en az 1 olmalıdır.'
                    );
                }

                if ($product->stock_quantity < $quantity) {
                    throw new RuntimeException(
                        "{$product->product_title} için yeterli stok bulunmamaktadır."
                    );
                }

                $unitPrice = (float) $product->list_price;

                $lineTotal = round(
                    $unitPrice * $quantity,
                    2
                );

                $subtotal += $lineTotal;

                $items->push([
                    'product' => $product,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'line_total' => $lineTotal,
                ]);
            }

            $subtotal = round($subtotal, 2);

            $campaignResult = $this->campaignEvaluator
                ->findBestCampaign(
                    $items,
                    $subtotal
                );

            $campaign = $campaignResult['campaign'];

            $discountAmount = round(
                (float) $campaignResult['discount_amount'],
                2
            );

            $shippingAmount = $subtotal >= 50
                ? 0
                : 10;

            $totalAmount = round(
                $subtotal
                - $discountAmount
                + $shippingAmount,
                2
            );

            $order = Order::create([
                'user_id' => $user->id,

                'order_number' => $this->generateOrderNumber(),

                'campaign_id' => $campaign?->id,

                'subtotal' => $subtotal,

                'discount_amount' => $discountAmount,

                'shipping_amount' => $shippingAmount,

                'total_amount' => $totalAmount,
            ]);

            foreach ($items as $item) {

                $product = $item['product'];

                $order->items()->create([
                    'product_id' => $product->id,

                    'product_title' => $product->product_title,

                    'unit_price' => $item['unit_price'],

                    'quantity' => $item['quantity'],

                    'line_total' => $item['line_total'],
                ]);

                $product->decrement(
                    'stock_quantity',
                    $item['quantity']
                );
            }

            return $order->load([
                'items',
                'campaign',
                'user',
            ]);
        });
    }

    private function generateOrderNumber(): string
    {
        do {
            $orderNumber = 'ORD-' . strtoupper(
                Str::random(10)
            );
        } while (
            Order::where('order_number', $orderNumber)->exists()
        );

        return $orderNumber;
    }
}