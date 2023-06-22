<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
Route::middleware(['guest'])->group(function(){
    Route::get('signup', [UserController::class , 'signup'])->name('signup');
    Route::post('signup', [UserController::class , 'create']);
    Route::get('login', [UserController::class , 'login'])->name('login');
    Route::post('login', [UserController::class , 'auth']);

});

Route::middleware(['auth'])->group(function(){
    Route::get('home', [userController::class , 'index'])->name('index');
    Route::get('chat', [userController::class , 'chat'])->name('chat');
 
});