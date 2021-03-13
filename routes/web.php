<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user', \App\Http\Livewire\User::class)->name('user.index');
Route::get('/user/create', \App\Http\Livewire\UserCreate::class)->name('user.create');
Route::get('/user/{user}/edit', \App\Http\Livewire\UserEdit::class)->name('user.edit');
Route::get('/sn', \App\Http\Livewire\Sn::class);
Route::get('/test', \App\Http\Livewire\Test::class);
Route::get('/weight', \App\Http\Livewire\Weight::class);
Route::get('/product', \App\Http\Livewire\Product::class)->name('product.index');
Route::get('/product/create', \App\Http\Livewire\ProductCreate::class)->name('product.create');
Route::get('/product/{product}/edit', \App\Http\Livewire\ProductEdit::class)->name('product.edit');
