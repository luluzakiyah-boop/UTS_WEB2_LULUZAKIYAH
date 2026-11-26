@extends('layouts.admin')
@section('title','Dashboard')
@section('content')
<div class="stats">
    <div class="stat-card">Total Produk<strong>{{ $productCount }}</strong></div>
    <div class="stat-card">Total Kategori<strong>{{ $categoryCount }}</strong></div>
    <div class="stat-card">Total Testimoni<strong>{{ $testimonialCount }}</strong></div>
</div>
<div class="table-wrap"><table class="table"><thead><tr><th>Produk Terbaru</th><th>Kategori</th><th>Harga</th><th>Status</th></tr></thead><tbody>
@foreach($latestProducts as $product)<tr><td><strong>{{ $product->name }}</strong></td><td>{{ $product->category->name }}</td><td>Rp {{ number_format($product->price,0,',','.') }}</td><td>{{ $product->is_available?'Tersedia':'Tidak tersedia' }}</td></tr>@endforeach
</tbody></table></div>
@endsection
