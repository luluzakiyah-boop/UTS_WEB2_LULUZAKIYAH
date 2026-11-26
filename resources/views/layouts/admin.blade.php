<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>@yield('title','Admin — L-Patisserie')</title>@vite(['resources/css/app.css','resources/js/app.js'])</head><body>
<div class="admin-shell">
    <aside class="admin-sidebar">
        <a class="brand" href="{{ route('admin.dashboard') }}">L-<span>Patisserie</span></a>
        <nav class="admin-nav">
            <a class="{{ request()->routeIs('admin.dashboard')?'active':'' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a class="{{ request()->routeIs('admin.products.*')?'active':'' }}" href="{{ route('admin.products.index') }}">Produk</a>
            <a class="{{ request()->routeIs('admin.categories.*')?'active':'' }}" href="{{ route('admin.categories.index') }}">Kategori</a>
            <a class="{{ request()->routeIs('admin.testimonials.*')?'active':'' }}" href="{{ route('admin.testimonials.index') }}">Testimoni</a>
            <a href="{{ route('home') }}" target="_blank">Lihat Website</a>
        </nav>
    </aside>
    <main class="admin-main">
        <header class="admin-header"><strong>@yield('title','Dashboard')</strong><form method="POST" action="{{ route('logout') }}">@csrf<button class="btn btn-outline btn-small">Keluar</button></form></header>
        <div class="admin-content">@yield('content')</div>
    </main>
</div>
</body></html>
