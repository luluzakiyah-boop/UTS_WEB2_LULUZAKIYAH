@extends('layouts.app')
@section('title','L-Patisserie — Sweet Moments')
@section('content')
<header class="container hero">
    <div>
        <span class="eyebrow">Fresh & Made with Love</span>
        <h1>Kue Manis untuk <em>Moments</em> Istimewa</h1>
        <p>Dibuat dengan bahan pilihan, sentuhan estetika, dan cita rasa yang membuat setiap perayaan terasa lebih berkesan.</p>
        <div class="hero-actions">
            <a class="btn btn-primary" href="{{ route('catalog') }}">Lihat Koleksi</a>
            <a class="btn btn-outline" href="{{ route('about') }}">Cerita Kami</a>
        </div>
    </div>
    <div class="hero-art">
        <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&w=900&q=85" alt="Kue L-Patisserie">
        <div class="floating-badge"><strong>Freshly baked</strong><br><small>setiap hari</small></div>
    </div>
</header>

<section class="section" style="background:white">
    <div class="container">
        <div class="section-head"><div><span class="eyebrow">Kategori Favorit</span><h2>Temukan Kesenanganmu</h2></div><a href="{{ route('catalog') }}">Lihat semua →</a></div>
        <div class="category-grid">
            @foreach($categories as $category)
            <a class="category-card" href="{{ route('catalog',['category'=>$category->slug]) }}">
                <div class="category-image">@if($category->image)<img src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->name }}">@else {{ $category->name }}@endif</div>
                <h3>{{ $category->name }}</h3><p>{{ $category->products_count }} produk</p>
            </a>
            @endforeach
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head"><div><span class="eyebrow">Pilihan Istimewa</span><h2>Produk Unggulan</h2></div><a href="{{ route('catalog') }}">Lihat katalog →</a></div>
        <div class="product-grid">
            @forelse($featured as $product)
            <a class="product-card" href="{{ route('product.show',$product->slug) }}">
                <div class="product-image">@if($product->image)<img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">@else {{ $product->name }}@endif</div>
                <div class="product-body"><span class="product-category">{{ $product->category->name }}</span><h3>{{ $product->name }}</h3><div class="product-meta"><span class="price">Rp {{ number_format($product->price,0,',','.') }}</span><span>→</span></div></div>
            </a>
            @empty
            <p>Belum ada produk unggulan.</p>
            @endforelse
        </div>
    </div>
</section>

<section class="section" style="background:#fdfaf6">
    <div class="container">
        <div class="section-head"><div><span class="eyebrow">Cerita Pelanggan</span><h2>Apa Kata Mereka?</h2></div></div>
        <div class="testimonial-grid">
            @foreach($testimonials as $testimonial)
            <article class="testimonial"><div class="stars">{{ str_repeat('★',$testimonial->rating) }}</div><p>“{{ $testimonial->message }}”</p><strong>{{ $testimonial->name }}</strong><small>{{ $testimonial->profession }}</small></article>
            @endforeach
        </div>
    </div>
</section>
<div class="container cta"><span class="eyebrow" style="color:white">Pesan untuk hari istimewa</span><h2>Wujudkan Kue Impianmu</h2><p>Konsultasikan desain dan rasa favoritmu bersama kami.</p><a class="btn" href="https://wa.me/6281234567890" target="_blank">Chat WhatsApp</a></div>
@endsection
