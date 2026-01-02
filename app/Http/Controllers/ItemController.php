<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('category')->paginate(10);
        $categories = Category::all();

        // Hitung statistik
        $item_count = Item::count();
        $item_stock = Item::where('stock', '>', 0)->sum('stock');
        $item_low_stock = Item::where('stock', '>', 0)->where('stock', '<=', 10)->count();
        $item_out_of_stock = Item::where('stock', 0)->count();

        return view('item', compact(
            'items',
            'categories',
            'item_count',
            'item_stock',
            'item_low_stock',
            'item_out_of_stock'
        ));
    }

    public function create()
    {
        $categories = Category::all();
        return view('item-create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_code' => 'required|unique:items,item_code',
            'name' => 'required|min:3',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'price' => 'required|integer|min:1',
        ]);

        $item = Item::create($validated);

        return response()->json([
            'message' => 'Barang berhasil ditambahkan',
            'data' => $item->load('category')
        ]);
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('item')->with('success', 'Barang berhasil dihapus');
    }

    // ItemController.php
    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('item-edit', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        // item_code tidak diupdate
        $item->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'category_id' => $validated['category_id'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Barang berhasil diperbarui'
        ]);
    }

    public function checkCode(Request $request)
    {
        $request->validate([
            'item_code' => 'required|string'
        ]);

        $exists = Item::where('item_code', $request->item_code)->exists();

        return response()->json([
            'exists' => $exists,
            'message' => $exists ? 'Kode sudah digunakan' : 'Kode tersedia'
        ]);
    }
}
