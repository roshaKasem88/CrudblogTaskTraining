<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'admin','middleware'=>'auth:admin'],
function(){
Route::resource('/',AdminController::class);
Route::resource('roles',RoleController::class);
});














?>
