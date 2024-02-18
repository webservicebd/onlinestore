<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use Livewire\Volt\Volt;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/login', [LoginController::class, 'login'])->name('login');

Volt::route('/', 'guest.shop')->name('shop');
Volt::route('/product/{product}', 'guest.product')->name('product');
Volt::route('/about', 'guest.about')->name('about');
Volt::route('/contact', 'guest.contact')->name('contact');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Volt::route('/dashboard', 'dashboard')->name('dashboard');
    Volt::route('/post', 'post.post')->name('post');
    Volt::route('/post-create', 'post.create')->name('post.create');
    Volt::route('/brand-create', 'brand.create')->name('brand.create');
    Volt::route('/category-create', 'category.create')->name('category.create');
    Volt::route('/product-create', 'product.create')->name('product.create');
    Volt::route('/product-show', 'product.product')->name('product.show');
});
