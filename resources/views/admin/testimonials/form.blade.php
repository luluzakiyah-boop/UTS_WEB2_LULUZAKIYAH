@extends('layouts.admin')
@section('title',$testimonial?'Edit Testimoni':'Tambah Testimoni')
@section('content')
<form class="content-card form-card" method="POST" action="{{ $testimonial?route('admin.testimonials.update',$testimonial):route('admin.testimonials.store') }}">@csrf @if($testimonial)@method('PUT')@endif
@if($errors->any())<div class="error" style="background:#fff1f3;padding:12px;border-radius:10px;margin-bottom:15px">@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>@endif
<div class="form-grid"><div class="form-group"><label>Nama Pelanggan</label><input class="input" name="name" value="{{ old('name',$testimonial->name ?? '') }}" required></div><div class="form-group"><label>Pekerjaan / Profesi</label><input class="input" name="profession" value="{{ old('profession',$testimonial->profession ?? '') }}"></div></div>
<div class="form-group"><label>Isi Testimoni</label><textarea class="textarea" name="message" required>{{ old('message',$testimonial->message ?? '') }}</textarea></div>
<div class="form-grid"><div class="form-group"><label>Rating (1–5)</label><input class="input" type="number" min="1" max="5" name="rating" value="{{ old('rating',$testimonial->rating ?? 5) }}" required></div><div class="form-group"><label>Status</label><div style="padding-top:13px"><input type="checkbox" name="is_active" value="1" @checked(old('is_active',$testimonial->is_active ?? true))> Aktif ditampilkan</div></div></div>
<div style="display:flex;gap:10px;margin-top:24px"><button class="btn btn-primary">Simpan</button><a class="btn btn-outline" href="{{ route('admin.testimonials.index') }}">Batal</a></div>
</form>
@endsection
