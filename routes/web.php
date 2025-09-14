<?php

use App\Livewire\Admin\Article\ArticleCreate;
use App\Livewire\Admin\Article\ArticleEdit;
use App\Livewire\Admin\Article\ArticleList;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Gallery\GalleryCreate;
use App\Livewire\Admin\Gallery\GalleryList;
use App\Livewire\Admin\Package\PackageCreate;
use App\Livewire\Admin\Package\PackageEdit;
use App\Livewire\Admin\Package\PackageList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Auth::routes();

Route::prefix('auth')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/package', PackageList::class)->name('package-list');
    Route::get('/package/create', PackageCreate::class)->name('package.create');
    Route::get('/package/edit/{id}', PackageEdit::class)->name('package.edit');
    Route::get('/gallery', GalleryList::class)->name('gallery.list');
    Route::get('/gallery/create', GalleryCreate::class)->name('gallery.create');
    Route::get('/article', ArticleList::class)->name('article.list');
    Route::get('/article/create', ArticleCreate::class)->name('article.create');
    Route::get('/article/edit/{id}', ArticleEdit::class)->name('article.edit');
});
