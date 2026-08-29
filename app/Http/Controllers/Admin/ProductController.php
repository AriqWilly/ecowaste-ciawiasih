<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Apply Search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Apply Category Filter
        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Apply Status Filter
        if ($request->filled('status')) {
            $isPublished = $request->status === 'aktif' ? 1 : 0;
            $query->where('is_published', $isPublished);
        }

        $products = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('admin.katalog.index', compact('products', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'seller_name' => 'required|string|max:255',
            'seller_phone' => 'required|string|max:25',
            'image' => 'nullable|image|max:5120', // 5MB limit
        ]);

        $product = new Product($validated);
        
        // Generate unique slug
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $count = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        $product->slug = $slug;
        $product->is_published = $request->has('is_published');

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $cloudinaryUrl = \App\Services\CloudinaryService::upload($request->file('image'), 'products');
            $product->image_path = $cloudinaryUrl ?: $request->file('image')->store('products', 'public');
        }

        $product->save();

        return redirect()->route('admin.katalog.index')->with('success', 'Produk berhasil ditambahkan ke katalog.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'seller_name' => 'required|string|max:255',
            'seller_phone' => 'required|string|max:25',
            'image' => 'nullable|image|max:5120',
        ]);

        $product->fill($validated);

        // Generate unique slug if name changed
        if ($product->isDirty('name')) {
            $slug = Str::slug($request->name);
            $originalSlug = $slug;
            $count = 1;
            while (Product::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            $product->slug = $slug;
        }

        $product->is_published = $request->has('is_published');

        // Handle Image Upload
        if ($request->hasFile('image')) {
            if ($product->image_path && !\Illuminate\Support\Str::startsWith($product->image_path, ['http://', 'https://'])) {
                Storage::disk('public')->delete($product->image_path);
            }
            $cloudinaryUrl = \App\Services\CloudinaryService::upload($request->file('image'), 'products');
            $product->image_path = $cloudinaryUrl ?: $request->file('image')->store('products', 'public');
        }

        $product->save();

        return redirect()->route('admin.katalog.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        
        // Delete image file from storage
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        return redirect()->route('admin.katalog.index')->with('success', 'Produk berhasil dihapus dari katalog.');
    }
}
