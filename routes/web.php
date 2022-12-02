<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('dashboard');
});
Auth::routes();

Route::resource('/blog', App\Http\Controllers\blogController::class);
Route::resource('/category', App\Http\Controllers\CategoryController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('roles',App\Http\Controllers\RoleController::class);



