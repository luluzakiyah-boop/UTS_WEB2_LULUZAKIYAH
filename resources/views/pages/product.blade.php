@extends('layouts.app')
@section('title',$product->name.' — L-Patisserie')
@section('content')
<main class="container product-detail">
    <div class="detail-image">@if($product->image)<img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">@else <h2>{{ $product->name }}</h2>@endif</div>
    <div class="detail-content">
        <span class="eyebrow">{{ $product->category->name }}</span>
        <h1>{{ $product->name }}</h1>
        <span class="availability">{{ $product->is_available ? 'Tersedia untuk dipesan' : 'Tidak tersedia' }}</span>
        <span class="price">Rp {{ number_format($product->price,0,',','.') }}</span>
        <p class="description">{{ $product->description }}</p>
        @if($product->is_available)
        <a class="btn btn-primary" href="https://wa.me/6281234567890?text={{ urlencode('Halo L-Patisserie, saya tertarik memesan '.$product->name) }}" target="_blank">Pesan via WhatsApp</a>
        @else
        <button class="btn" disabled style="background:#ddd">Produk tidak tersedia</button>
        @endif
    </div>
</main>
@if($related->isNotEmpty())
<section class="section" style="background:white"><div class="container"><div class="section-head"><div><span class="eyebrow">Lainnya</span><h2>Produk Serupa</h2></div></div><div class="product-grid">
@foreach($related as $item)<a class="product-card" href="{{ route('product.show',$item->slug) }}"><div class="product-image">@if($item->image)<img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->name }}">@else {{ $item->name }}@endif</div><div class="product-body"><h3>{{ $item->name }}</h3><span class="price">Rp {{ number_format($item->price,0,',','.') }}</span></div></a>@endforeach
</div></div></section>@endif
@endsection
