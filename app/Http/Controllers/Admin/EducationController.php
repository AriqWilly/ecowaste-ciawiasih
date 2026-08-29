<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EducationalContent;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = EducationalContent::with('category');

        // Search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by status (diterbitkan / draft)
        if ($request->filled('status')) {
            if ($request->status === 'diterbitkan') {
                $query->whereNotNull('published_at');
            } elseif ($request->status === 'draft') {
                $query->whereNull('published_at');
            }
        }

        $articles = $query->latest('created_at')->paginate(10)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('admin.edukasi.index', compact('articles', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'media' => 'nullable|image|max:5120',
            'status' => 'required|in:diterbitkan,draft',
        ]);

        $article = new EducationalContent();
        $article->title = $validated['title'];
        $article->category_id = $validated['category_id'];
        $article->content = $validated['content'];

        // Generate unique slug
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
        while (EducationalContent::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        $article->slug = $slug;

        // Set publish date
        $article->published_at = ($request->status === 'diterbitkan') ? now() : null;

        // Handle Image Upload
        if ($request->hasFile('media')) {
            $cloudinaryUrl = \App\Services\CloudinaryService::upload($request->file('media'), 'education');
            $article->media_path = $cloudinaryUrl ?: $request->file('media')->store('education', 'public');
        }

        $article->save();

        return redirect()->route('admin.edukasi.index')->with('success', 'Artikel edukasi berhasil dibuat.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = EducationalContent::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'media' => 'nullable|image|max:5120',
            'status' => 'required|in:diterbitkan,draft',
        ]);

        $article->title = $validated['title'];
        $article->category_id = $validated['category_id'];
        $article->content = $validated['content'];

        // Update slug if title changed
        if ($article->isDirty('title')) {
            $slug = Str::slug($request->title);
            $originalSlug = $slug;
            $count = 1;
            while (EducationalContent::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            $article->slug = $slug;
        }

        // Update published_at
        if ($request->status === 'diterbitkan') {
            if (!$article->published_at) {
                $article->published_at = now();
            }
        } else {
            $article->published_at = null;
        }

        // Handle Image Upload
        if ($request->hasFile('media')) {
            if ($article->media_path && !\Illuminate\Support\Str::startsWith($article->media_path, ['http://', 'https://'])) {
                Storage::disk('public')->delete($article->media_path);
            }
            $cloudinaryUrl = \App\Services\CloudinaryService::upload($request->file('media'), 'education');
            $article->media_path = $cloudinaryUrl ?: $request->file('media')->store('education', 'public');
        }

        $article->save();

        return redirect()->route('admin.edukasi.index')->with('success', 'Artikel edukasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = EducationalContent::findOrFail($id);

        if ($article->media_path) {
            Storage::disk('public')->delete($article->media_path);
        }

        $article->delete();

        return redirect()->route('admin.edukasi.index')->with('success', 'Artikel edukasi berhasil dihapus.');
    }
}
