@extends('layouts.admin')
@section('title','Manajemen Kategori')
@section('content')
@if(session('success'))<div class="success">{{ session('success') }}</div>@endif
@if($errors->any())<div class="error" style="margin-bottom:12px">{{ $errors->first() }}</div>@endif
<div style="display:flex;justify-content:flex-end;margin-bottom:15px"><a class="btn btn-primary" href="{{ route('admin.categories.create') }}">+ Tambah Kategori</a></div>
<div class="table-wrap"><table class="table"><thead><tr><th>Nama</th><th>Slug</th><th>Jumlah Produk</th><th>Aksi</th></tr></thead><tbody>
@foreach($categories as $category)<tr><td><strong>{{ $category->name }}</strong></td><td>{{ $category->slug }}</td><td>{{ $category->products_count }}</td><td><div class="table-actions"><a class="btn btn-outline btn-small" href="{{ route('admin.categories.edit',$category) }}">Edit</a><form method="POST" action="{{ route('admin.categories.destroy',$category) }}" onsubmit="return confirm('Hapus kategori ini?')">@csrf @method('DELETE')<button class="btn btn-outline btn-small danger">Hapus</button></form></div></td></tr>@endforeach
</tbody></table></div><div style="margin-top:20px">{{ $categories->links() }}</div>
@endsection
