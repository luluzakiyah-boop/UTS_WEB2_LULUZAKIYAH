@extends('layouts.admin')
@section('title',$product?'Edit Produk':'Tambah Produk')
@section('content')
<form class="content-card form-card" method="POST" enctype="multipart/form-data" action="{{ $product?route('admin.products.update',$product):route('admin.products.store') }}">@csrf @if($product)@method('PUT')@endif
@if($errors->any())<div class="error" style="background:#fff1f3;padding:12px;border-radius:10px;margin-bottom:15px">@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>@endif
<div class="form-grid"><div class="form-group"><label>Nama Produk</label><input class="input" name="name" value="{{ old('name',$product->name ?? '') }}" required></div><div class="form-group"><label>Kategori</label><select class="select" name="category_id" required><option value="">Pilih kategori</option>@foreach($categories as $category)<option value="{{ $category->id }}" @selected(old('category_id',$product->category_id ?? '')==$category->id)>{{ $category->name }}</option>@endforeach</select></div></div>
<div class="form-grid"><div class="form-group"><label>Harga (Rp)</label><input class="input" type="number" name="price" min="0" value="{{ old('price',$product->price ?? '') }}" required></div><div class="form-group"><label>Foto Produk</label><input class="input" type="file" name="image" accept="image/*"></div></div>
@if($product && $product->image)<div class="form-group"><label>Foto Saat Ini</label><img class="admin-form-preview" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}"></div>@endif
<div class="form-group"><label>Deskripsi</label><textarea class="textarea" name="description" required>{{ old('description',$product->description ?? '') }}</textarea></div>
<div class="form-grid"><label><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured',$product->is_featured ?? false))> Produk unggulan</label><label><input type="checkbox" name="is_available" value="1" @checked(old('is_available',$product->is_available ?? true))> Tersedia</label></div>
<div style="display:flex;gap:10px;margin-top:24px"><button class="btn btn-primary">Simpan</button><a class="btn btn-outline" href="{{ route('admin.products.index') }}">Batal</a></div>
</form>
@endsection
