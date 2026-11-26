<?php

use App\Http\Controllers\Admin\CategoryManagementController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductManagementController;
use App\Http\Controllers\Admin\TestimonialManagementController;
use App\Http\Controllers\PublicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/katalog', [PublicController::class, 'catalog'])->name('catalog');
Route::get('/produk/{slug}', [PublicController::class, 'product'])->name('product.show');
Route::view('/tentang-kami', 'pages.about')->name('about');
Route::view('/kontak', 'pages.contact')->name('contact');

Route::get('/admin/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

Route::post('/admin/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);
    if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'is_admin' => true], $request->boolean('remember'))) {
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    return back()->withErrors(['email' => 'Email atau password tidak sesuai.'])->onlyInput('email');
})->middleware('guest');

Route::post('/admin/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->middleware('auth')->name('logout');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductManagementController::class)->except(['show']);
    Route::resource('categories', CategoryManagementController::class)->except(['show']);
    Route::resource('testimonials', TestimonialManagementController::class)->except(['show']);
});
