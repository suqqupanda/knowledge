<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// 新規登録画面を表示
Route::get('/user/create', [UserController::class, 'showRegister'])->name('register');

// 新規登録
Route::post('/user/create', [UserController::class, 'create'])->name('userStore');

Route::group(['middleware' => 'auth'], function() {
    // postグループ
    Route::group(['prefix' => 'post', 'as' => 'post'], function() {
        // 投稿作成画面を表示
        Route::get('/create', [PostController::class, 'showPost'])->name('.show');
        // 投稿を作成
        Route::post('/create', [PostController::class, 'createPost'])->name('.create');
        // 投稿一覧画面を表示
        Route::get('/index', [PostController::class, 'indexPost'])->name('.index');
        // 投稿詳細画面を表示
        Route::get('/detail/{id}', [PostController::class, 'detailPost'])->name('.detail');
    });
});
