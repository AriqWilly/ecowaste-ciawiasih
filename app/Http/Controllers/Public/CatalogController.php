<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Models\Product;

class CatalogController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $query = Product::where('is_published', true)->with('category');

        if (request('search')) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }

        if (request('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', request('category')));
        }

        if (request('sort') === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif (request('sort') === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        $products   = $query->paginate(12)->withQueryString();
        $categories = \App\Models\Category::whereHas('products', fn($q) => $q->where('is_published', true))
                        ->orderBy('name')
                        ->get();

        return view('public.katalog.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $waLink = $this->productService->generateWhatsAppLink($product);
        
        return view('public.katalog.show', compact('product', 'waLink'));
    }
}
