<?php

use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Package\PackageList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/package', PackageList::class)->name('package-list');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
