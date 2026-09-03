<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CustomerShopController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'author'])
            ->where('status', true)
            ->get();

        return view('customer.shop.index', compact('products'));
    }
}