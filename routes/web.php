<?php

use App\Livewire\Counter;
use App\Livewire\Post\Index;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Route untuk Counter
    Route::get('/counter', Counter::class)->name('counter');
    
    // Route untuk daftar Post
    Route::get('/post.index', Index::class)->name('post.index');
});
