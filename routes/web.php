<?php

use App\Http\Livewire\Categories\Categories;
use App\Http\Livewire\Categories\Categoryposts;
use App\Http\Livewire\Posts\Posts;
use App\Http\Livewire\Posts\Post as P;
use App\Http\Livewire\Tags\Tagposts;
use App\Http\Livewire\Tags\Tags;
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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard/categories', Categories::class)->name('categories');
    Route::get('dashboard/categories/{id}/posts', Categoryposts::class);

    Route::get('dashboard/posts', Posts::class)->name('posts');
    Route::get('dashboard/posts/{id}', P::class)->name('post');

    Route::get('dashboard/tags', Tags::class)->name('tags');
    Route::get('dashboard/tags/{id}/posts', Tagposts::class);
});
