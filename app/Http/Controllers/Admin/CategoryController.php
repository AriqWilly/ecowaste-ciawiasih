<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index(Request $request)
    {
        $query = Category::withCount(['products', 'educationalContents']);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $categories = $query->orderBy('name')->paginate(10)->withQueryString();

        return view('admin.kategori.index', compact('categories'));
    }

    /**
     * Store a newly created category.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = new Category();
        $category->name = $validated['name'];
        $category->description = $validated['description'] ?? null;

        // Generate unique slug
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $count = 1;
        while (Category::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        $category->slug = $slug;

        $category->save();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    /**
     * Update the specified category.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->name = $validated['name'];
        $category->description = $validated['description'] ?? null;

        if ($category->isDirty('name')) {
            $slug = Str::slug($request->name);
            $originalSlug = $slug;
            $count = 1;
            while (Category::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            $category->slug = $slug;
        }

        $category->save();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified category.
     */
    public function destroy(string $id)
    {
        $category = Category::withCount(['products', 'educationalContents'])->findOrFail($id);

        if ($category->products_count > 0 || $category->educational_contents_count > 0) {
            return redirect()->route('admin.kategori.index')->withErrors([
                'delete' => "Kategori '{$category->name}' tidak dapat dihapus karena masih memiliki {$category->products_count} produk dan {$category->educational_contents_count} artikel edukasi terkait."
            ]);
        }

        $category->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
