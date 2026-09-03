<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\CampaignEvaluator;

class CustomerCartController extends Controller
{
    public function index(CampaignEvaluator $campaignEvaluator)
{
    $cart = session()->get('cart', []);

    $items = collect();

    foreach ($cart as $item) {
        $product = \App\Models\Product::find($item['product_id']);

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

    return view('customer.cart.index', compact(
        'cart',
        'subtotal',
        'campaignResult'
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