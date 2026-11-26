@extends('layouts.admin')
@section('title',$category?'Edit Kategori':'Tambah Kategori')
@section('content')
<form class="content-card form-card" method="POST" enctype="multipart/form-data" action="{{ $category?route('admin.categories.update',$category):route('admin.categories.store') }}">@csrf @if($category)@method('PUT')@endif
@if($errors->any())<div class="error" style="background:#fff1f3;padding:12px;border-radius:10px;margin-bottom:15px">@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>@endif
<div class="form-group"><label>Nama Kategori</label><input class="input" name="name" value="{{ old('name',$category->name ?? '') }}" required></div>
<div class="form-group"><label>Deskripsi</label><textarea class="textarea" name="description">{{ old('description',$category->description ?? '') }}</textarea></div>
<div class="form-group"><label>Gambar Kategori</label><input class="input" type="file" name="image" accept="image/*"></div>
<div style="display:flex;gap:10px;margin-top:24px"><button class="btn btn-primary">Simpan</button><a class="btn btn-outline" href="{{ route('admin.categories.index') }}">Batal</a></div>
</form>
@endsection
