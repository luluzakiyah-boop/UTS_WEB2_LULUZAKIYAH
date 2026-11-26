<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Admin Login — L-Patisserie</title>@vite(['resources/css/app.css','resources/js/app.js'])</head><body class="login-page">
<form class="login-card" method="POST" action="{{ url('/admin/login') }}">@csrf
    <a class="brand" href="{{ route('home') }}" style="display:block;text-align:center">L-<span>Patisserie</span></a>
    <h1>Masuk Admin</h1>
    @if($errors->any())<div class="error" style="background:#fff1f3;padding:10px;border-radius:10px;margin-bottom:12px">{{ $errors->first() }}</div>@endif
    <div class="form-group"><label>Email</label><input class="input" type="email" name="email" value="{{ old('email') }}" required></div>
    <div class="form-group"><label>Password</label><input class="input" type="password" name="password" required></div>
    <button class="btn btn-primary" style="width:100%">Masuk Dashboard</button>
</form>
</body></html>
