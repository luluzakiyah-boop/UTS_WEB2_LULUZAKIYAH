<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Testimonial;

class PublicController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'categories' => Category::withCount('products')->get(),
            'featured' => Product::where('is_featured', true)->where('is_available', true)->with('category')->latest()->take(4)->get(),
            'testimonials' => Testimonial::where('is_active', true)->latest()->take(3)->get(),
        ]);
    }

    public function catalog()
    {
        $query = Product::where('is_available', true)->with('category');
        if (request('search')) {
            $query->where('name', 'like', '%'.request('search').'%');
        }
        if (request('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', request('category')));
        }

        return view('pages.catalog', [
            'products' => $query->latest()->paginate(9)->withQueryString(),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function product(string $slug)
    {
        $product = Product::where('slug', $slug)->with('category')->firstOrFail();
        $related = Product::where('category_id', $product->category_id)
            ->whereKeyNot($product->id)
            ->where('is_available', true)
            ->take(3)->get();

        return view('pages.product', compact('product', 'related'));
    }
}
