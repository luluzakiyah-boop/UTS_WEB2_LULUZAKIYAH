<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->latest();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->string('search').'%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->integer('category'));
        }

        $products = $query->paginate(10)->withQueryString();

        return view('admin.products.index', [
            'products' => $products,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.products.form', ['product' => null, 'categories' => Category::orderBy('name')->get()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateProduct($request);
        $data['slug'] = Str::slug($data['name']);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_available'] = $request->boolean('is_available');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.form', ['product' => $product, 'categories' => Category::orderBy('name')->get()]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validateProduct($request);
        $data['slug'] = Str::slug($data['name']);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_available'] = $request->boolean('is_available');
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }

    private function validateProduct(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['required', 'string', 'min:10', 'max:5000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);
    }
}
