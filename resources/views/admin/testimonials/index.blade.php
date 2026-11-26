@extends('layouts.admin')
@section('title','Manajemen Testimoni')
@section('content')
@if(session('success'))<div class="success">{{ session('success') }}</div>@endif
<div style="display:flex;justify-content:flex-end;margin-bottom:15px"><a class="btn btn-primary" href="{{ route('admin.testimonials.create') }}">+ Tambah Testimoni</a></div>
<div class="table-wrap"><table class="table"><thead><tr><th>Pelanggan</th><th>Rating</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
@foreach($testimonials as $testimonial)<tr><td><strong>{{ $testimonial->name }}</strong><br><small>{{ $testimonial->profession }}</small></td><td>{{ str_repeat('★',$testimonial->rating) }}</td><td>{{ $testimonial->is_active?'Aktif':'Tidak aktif' }}</td><td><div class="table-actions"><a class="btn btn-outline btn-small" href="{{ route('admin.testimonials.edit',$testimonial) }}">Edit</a><form method="POST" action="{{ route('admin.testimonials.destroy',$testimonial) }}" onsubmit="return confirm('Hapus testimoni ini?')">@csrf @method('DELETE')<button class="btn btn-outline btn-small danger">Hapus</button></form></div></td></tr>@endforeach
</tbody></table></div><div style="margin-top:20px">{{ $testimonials->links() }}</div>
@endsection
