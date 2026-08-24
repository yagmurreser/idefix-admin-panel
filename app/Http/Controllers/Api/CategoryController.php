<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return response()->json($categories);
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);

        return response()->json($category);
    }

    public function store(Request $request)
   {
    $validated = $request->validate([
        'category_title' => 'required',
        'category_description' => 'nullable',
        'status' => 'required|in:0,1',
    ]);

    $category = Category::create($validated);

    return response()->json($category, 201);
    }


    public function update(Request $request, $id)
{
    $category = Category::findOrFail($id);

    $validated = $request->validate([
        'category_title' => 'required',
        'category_description' => 'nullable',
        'status' => 'required|in:0,1',
    ]);

    $category->update($validated);

    return response()->json($category);
}
    
  
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return response()->json([
            'message' => 'Kategori başarıyla silindi'
        ]);
    }
}

