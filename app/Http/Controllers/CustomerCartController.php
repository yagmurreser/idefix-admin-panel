<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CampaignEvaluator;
use Illuminate\Http\Request;

class CustomerCartController extends Controller
{
    public function index(CampaignEvaluator $campaignEvaluator)
    {
        $cart = session()->get('cart', []);

        $items = collect();

        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);

            if ($product) {
                $items->push([
                    'product' => $product,
                    'quantity' => $item['quantity'],
                ]);
            }
        }

        $subtotal = $items->sum(function ($item) {
            return $item['product']->list_price * $item['quantity'];
        });

        $campaignResult = $campaignEvaluator->findBestCampaign(
            $items,
            $subtotal
        );

        $discountAmount = $campaignResult['discount_amount'];

        $shippingAmount = $subtotal >= 50 ? 0 : 10;

        $totalAmount = round(
            $subtotal - $discountAmount + $shippingAmount,
            2
        );

        return view('customer.cart.index', compact(
            'cart',
            'subtotal',
            'campaignResult',
            'discountAmount',
            'shippingAmount',
            'totalAmount'
        ));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $quantity = (int) $request->quantity;

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'product_id' => $product->id,
                'product_title' => $product->product_title,
                'unit_price' => $product->list_price,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect()
            ->route('customer.cart.index')
            ->with('success', 'Ürün sepete eklendi.');
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);

        unset($cart[$product->id]);

        session()->put('cart', $cart);

        return redirect()
            ->route('customer.cart.index')
            ->with('success', 'Ürün sepetten çıkarıldı.');
    }
}