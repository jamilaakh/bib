<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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

Route::view('/','main')->name("index");

Route::view('/about', "about")->name("about");
Route::view('/contact', "contact")->name("contact");
Route::view('/details', "details")->name("details");

Route::view('/login', "login")->name("login");
Route::post('/login', 'App\Http\Controllers\UserController@login');

Route::view('/signup', "signup")->name("signup");
Route::post('/signup', 'App\Http\Controllers\UserController@store');

Route::post('/logout', 'App\Http\Controllers\UserController@logout')->name("logout");

Route::middleware(["auth"])->group(function () {
    Route::view('/profile', 'profile')->name("profile");
    Route::put("/profile/update/{user}", 'App\Http\Controllers\UserController@update')->name("profile.update");
    Route::resource("books", BookController::class);
});