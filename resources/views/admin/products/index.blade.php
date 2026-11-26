@extends('layouts.admin')
@section('title','Manajemen Produk')
@section('content')
@if(session('success'))<div class="success">{{ session('success') }}</div>@endif
<div class="admin-toolbar">
    <form class="admin-product-filter" method="GET" action="{{ route('admin.products.index') }}">
        <input class="input" type="search" name="search" value="{{ request('search') }}" placeholder="Cari nama produk...">
        <select class="select" name="category" onchange="this.form.submit()">
            <option value="">Semua kategori</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(request('category') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        <button class="btn btn-outline btn-small" type="submit">Cari</button>
    </form>
    <a class="btn btn-primary" href="{{ route('admin.products.create') }}">+ Tambah Produk</a>
</div>
<div class="table-wrap"><table class="table"><thead><tr><th>Foto</th><th>Produk</th><th>Kategori</th><th>Harga</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
@forelse($products as $product)
<tr>
<td>@if($product->image)<img class="admin-product-thumb" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">@else<span class="admin-product-thumb admin-thumb-empty">No<br>Image</span>@endif</td>
<td><strong>{{ $product->name }}</strong></td><td>{{ $product->category->name }}</td><td>Rp {{ number_format($product->price,0,',','.') }}</td><td>{{ $product->is_available?'Tersedia':'Tidak tersedia' }}{{ $product->is_featured?' • Unggulan':'' }}</td><td><div class="table-actions"><a class="btn btn-outline btn-small" href="{{ route('admin.products.edit',$product) }}">Ubah</a><form method="POST" action="{{ route('admin.products.destroy',$product) }}" onsubmit="return confirm('Hapus produk {{ $product->name }}?')">@csrf @method('DELETE')<button class="btn btn-outline btn-small danger">Hapus</button></form></div></td></tr>
@empty
<tr><td colspan="6" style="text-align:center;padding:35px">Belum ada produk yang sesuai pencarian.</td></tr>
@endforelse
</tbody></table></div><div style="margin-top:20px">{{ $products->links() }}</div>
@endsection
