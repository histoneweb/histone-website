<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/category/{slug}', [BlogController::class, 'category'])->name('blog.category');

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Legal Pages
Route::get('/privacy-policy', function () {
    return view('legal.privacy-policy');
})->name('privacy-policy');

Route::get('/terms-of-service', function () {
    return view('legal.terms-of-service');
})->name('terms-of-service');

Route::get('/cookie-policy', function () {
    return view('legal.cookie-policy');
})->name('cookie-policy');
