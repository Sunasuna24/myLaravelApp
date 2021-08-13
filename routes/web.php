<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\UserController;

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
// welcomeページ
// Route::get('/', [HomeController::class, 'index'])->name('home');


// ホーム画面
Route::get('/home', [HomeController::class, 'index'])->name('home');

// 登録画面
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'new_user']);

// ログイン画面
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

// ログアウト
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

// 投稿
Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::post('/posts', [PostController::class, 'create']);
Route::get('/post/{id}', [PostController::class, 'show'])->name('show');
Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('edit');
Route::put('post/{id}/edit', [PostController::class, 'update']);
Route::post('post/{id}', [PostController::class, 'destroy'])->name('destroy');

// いいね
Route::post('/posts/{post}/likes', [PostLikeController::class, 'store'])->name('posts.likes');
Route::delete('/posts/{post}/likes', [PostLikeController::class, 'destroy'])->name('posts.likes');

// ユーザー画面
Route::get('/{user}', [UserController::class, 'index'])->name('user');
Route::get('/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/{user}/edit', [UserController::class, 'update']);