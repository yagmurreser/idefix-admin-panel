<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;



class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return response()->json($products);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return response()->json($product);
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'product_title' => 'required',
        'category_id' => 'nullable|exists:categories,id',
        'barcode' => 'required',
        'status' => 'required|in:0,1',
    ]);

    $product = Product::create($validated);

    return response()->json($product, 201);
}

    public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $validated = $request->validate([
        'product_title' => 'required',
        'category_id' => 'nullable|exists:categories,id',
        'barcode' => 'required',
        'status' => 'required|in:0,1',
    ]);

    $product->update($validated);

    return response()->json($product);
}
    
  
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return response()->json([
            'message' => 'Ürün başarıyla silindi'
        ]);
    }

}