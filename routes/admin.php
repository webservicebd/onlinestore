<?php

use Illuminate\Support\Facades\Route;
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

Route::middleware([
  'auth:sanctum',
  config('jetstream.auth_session'),
  'verified',
  'admin',
])->group(function () {
  Volt::route('/admin', 'admin.dashboard')->name('admin.dashboard');
});
