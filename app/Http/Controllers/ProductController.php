<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();

        return view('admin.products.index', compact('products'));
    }

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

    public function edit(Product $product)
    {
        $categories = Category::all();

        return view(
            'admin.products.edit',
            compact('product', 'categories')
        );
    }

    public function update(Request $request, Product $product)
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

        $product->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Ürün başarıyla güncellendi.');
    }

    public function delete(Product $product)
    {
        return view('admin.products.delete', compact('product'));
    }

    public function destroy(Product $product)
{
    $product->delete();

    return redirect()
        ->route('admin.products.index');
}


}