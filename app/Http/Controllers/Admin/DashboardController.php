<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'productCount' => Product::count(),
            'categoryCount' => Category::count(),
            'testimonialCount' => Testimonial::count(),
            'latestProducts' => Product::with('category')->latest()->take(5)->get(),
        ]);
    }
}
