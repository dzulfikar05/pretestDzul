<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Api\MenuController;

/**
 * route "/register"
 * @method "POST"
 */
Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');

/**
 * route "/login"
 * @method "POST"
 */
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');

/**
 * route "/user"
 * @method "GET"
 */
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * route "/logout"
 * @method "POST"
 */
Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');


// Menu
/**
 * route "/menus"
 * @method "POST"
 */
Route::post('menus/update/{id}',[App\Http\Controllers\Api\MenuController::class, 'update']);
Route::resource('menus', App\Http\Controllers\Api\MenuController::class);

Route::post('categorys/update/{id}',[App\Http\Controllers\Api\CategoryController::class, 'update']);
Route::resource('categorys', App\Http\Controllers\Api\CategoryController::class);

Route::post('tags/update/{id}',[App\Http\Controllers\Api\TagController::class, 'update']);
Route::resource('tags',App\Http\Controllers\Api\TagController::class);

Route::post('users/update/{id}',[App\Http\Controllers\Api\UserController::class, 'update']);
Route::resource('users',App\Http\Controllers\Api\UserController::class);