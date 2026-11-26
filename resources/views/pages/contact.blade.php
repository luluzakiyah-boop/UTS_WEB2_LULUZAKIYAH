@extends('layouts.app')
@section('title','Kontak — L-Patisserie')
@section('content')
<header class="page-hero"><span class="eyebrow">Hubungi Kami</span><h1>Mulai Pesananmu</h1></header>
<main class="container contact-grid">
    <div class="content-card"><h2>L-Patisserie</h2><div class="contact-item"><strong>WhatsApp</strong><span>0812-3456-7890</span></div><div class="contact-item"><strong>Alamat</strong><span>Alamat usaha akan diperbarui sesuai lokasi toko.</span></div><div class="contact-item"><strong>Jam Operasional</strong><span>Senin–Sabtu, 08.00–18.00</span></div><a class="btn btn-primary" href="https://wa.me/6281234567890" target="_blank">Chat WhatsApp</a></div>
    <div class="content-card" style="background:var(--soft)"><span class="eyebrow">Pesan Khusus</span><h2>Kue untuk Acara Spesial?</h2><p style="line-height:1.8">Ceritakan tema, tanggal acara, rasa, dan jumlah kue yang kamu butuhkan. Tim kami siap membantu mewujudkannya.</p><a class="btn btn-outline" href="https://wa.me/6281234567890?text={{ urlencode('Halo L-Patisserie, saya ingin konsultasi pesanan khusus.') }}" target="_blank">Konsultasi Sekarang</a></div>
</main>
@endsection
