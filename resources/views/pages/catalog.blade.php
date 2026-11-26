@extends('layouts.app')
@section('title','Katalog Produk — L-Patisserie')
@section('content')
<header class="page-hero"><span class="eyebrow">Koleksi Manis</span><h1>Katalog Produk</h1><p>Temukan kue dan pastry favorit untuk setiap momen.</p></header>
<main class="container">
    <form class="toolbar" method="GET">
        <input class="input search" type="search" name="search" value="{{ request('search') }}" placeholder="Cari nama produk...">
        <select class="select" name="category" style="max-width:220px" onchange="this.form.submit()">
            <option value="">Semua kategori</option>
            @foreach($categories as $category)<option value="{{ $category->slug }}" @selected(request('category') == $category->slug)>{{ $category->name }}</option>@endforeach
        </select>
    </form>
    <div class="product-grid">
        @forelse($products as $product)
        <a class="product-card" href="{{ route('product.show',$product->slug) }}">
            <div class="product-image">@if($product->image)<img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">@else {{ $product->name }}@endif</div>
            <div class="product-body"><span class="product-category">{{ $product->category->name }}</span><h3>{{ $product->name }}</h3><div class="product-meta"><span class="price">Rp {{ number_format($product->price,0,',','.') }}</span><span>→</span></div></div>
        </a>
        @empty
        <div class="content-card" style="grid-column:1/-1;text-align:center"><h3>Produk tidak ditemukan</h3><p>Coba kata kunci atau kategori lain.</p></div>
        @endforelse
    </div>
    <div class="pagination">{{ $products->links() }}</div>
</main>
@endsection
