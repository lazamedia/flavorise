<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderByDesc('created_at')->paginate(10);
        return view('apps.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('apps.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $validated['is_active'] = (bool) ($validated['is_active'] ?? true);

        Category::create($validated);

        return redirect()->route('apps.categories.index')->with('success', 'Kategori berhasil dibuat.');
    }

    public function show(Category $category)
    {
        return view('apps.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('apps.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            // delete old image if exists
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        $category->update($validated);

        return redirect()->route('apps.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('apps.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}


