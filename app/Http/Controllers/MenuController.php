<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Menu::with('category')->orderByDesc('created_at');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->integer('category_id'));
        }

        if ($request->filled('q')) {
            $query->where('name', 'like', '%'.$request->q.'%');
        }

        $menus = $query->paginate(10)->withQueryString();
        $categories = Category::orderBy('name')->get(['id','name']);

        return view('apps.menus.index', compact('menus', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get(['id','name']);
        return view('apps.menus.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'image', 'max:2048'],
            'stock' => ['nullable', 'integer', 'min:0'],
            'is_available' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('menus', 'public');
        }

        $validated['stock'] = (int) ($validated['stock'] ?? 0);
        $validated['is_available'] = (bool) ($validated['is_available'] ?? true);

        Menu::create($validated);

        return redirect()->route('apps.menus.index')->with('success', 'Menu berhasil dibuat.');
    }

    public function show(Menu $menu)
    {
        $menu->load('category');
        return view('apps.menus.show', compact('menu'));
    }

    public function edit(Menu $menu)
    {
        $categories = Category::orderBy('name')->get(['id','name']);
        return view('apps.menus.edit', compact('menu','categories'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'image', 'max:2048'],
            'stock' => ['nullable', 'integer', 'min:0'],
            'is_available' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $validated['image'] = $request->file('image')->store('menus', 'public');
        }

        $validated['stock'] = (int) ($validated['stock'] ?? 0);
        $validated['is_available'] = (bool) ($validated['is_available'] ?? false);

        $menu->update($validated);

        return redirect()->route('apps.menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }
        $menu->delete();

        return redirect()->route('apps.menus.index')->with('success', 'Menu berhasil dihapus.');
    }
}


