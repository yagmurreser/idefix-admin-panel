<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_title' => [
                'required',
                'string',
                'max:255',
            ],
            'category_id' => [
                'nullable',
                'exists:categories,id',
            ],
            'barcode' => [
                'required',
                'string',
                'max:255',
            ],
            'status' => [
                'required',
                'boolean',
            ],
        ]);

        Product::create($validated);

        return redirect()
            ->route('admin.products.create')
            ->with('success', 'Ürün başarıyla eklendi.');
    }
}