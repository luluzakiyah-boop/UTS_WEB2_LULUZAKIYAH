<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'L-Patisserie')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <nav class="navbar">
        <div class="container nav-inner">
            <a class="brand" href="{{ route('home') }}">L-<span>Patisserie</span></a>
            <div class="nav-links">
                <a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                <a class="{{ request()->routeIs('catalog') ? 'active' : '' }}" href="{{ route('catalog') }}">Katalog</a>
                <a class="{{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Tentang Kami</a>
                <a class="{{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Kontak</a>
                <a class="btn btn-primary btn-small" href="https://wa.me/6281234567890" target="_blank">Pesan Sekarang</a>
            </div>
        </div>
    </nav>
    @yield('content')
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <h3>L-Patisserie</h3>
                    <p>Sweet Moments, Made with Love.</p>
                    <p>Kue dan pastry cantik untuk ulang tahun, hadiah, dan momen spesial.</p>
                </div>
                <div><h3>Menu</h3><p><a href="{{ route('catalog') }}">Katalog Produk</a></p><p><a href="{{ route('about') }}">Tentang Kami</a></p></div>
                <div><h3>Kontak</h3><p>WhatsApp: 0812-3456-7890</p><p>Senin–Sabtu, 08.00–18.00</p></div>
            </div>
            <div class="footer-bottom">© {{ date('Y') }} L-Patisserie. Dibuat dengan cinta.</div>
        </div>
    </footer>
</body>
</html>
