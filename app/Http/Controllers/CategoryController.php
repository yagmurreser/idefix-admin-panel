<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_title' => [
                'required',
                'string',
                'max:255',
                'unique:categories,category_title',
            ],
            'category_description' => [
                'nullable',
                'string',
            ],
            'status' => [
                'required',
                'boolean',
            ],
        ]);

        Category::create($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori başarıyla eklendi.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'category_title' => [
                'required',
                'string',
                'max:255',
                'unique:categories,category_title,' . $category->id,
            ],
            'category_description' => [
                'nullable',
                'string',
            ],
            'status' => [
                'required',
                'boolean',
            ],
        ]);

        $category->update($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori başarıyla güncellendi.');
    }

    public function delete(Category $category)
    {
        return view('admin.categories.delete', compact('category'));
    }
}