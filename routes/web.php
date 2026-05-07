<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| トップ
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| 認証（Laravel UI）
|--------------------------------------------------------------------------
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| ホーム
|--------------------------------------------------------------------------
*/
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');

/*
|--------------------------------------------------------------------------
| 商品機能
|--------------------------------------------------------------------------
*/

/**
 * 商品一覧（検索）
 */
Route::get('/product', [ProductController::class, 'index'])
    ->middleware('auth')
    ->name('product.index');

/**
 * 商品登録画面
 */
Route::get('/product/create', [ProductController::class, 'create'])
    ->middleware('auth')
    ->name('product.create');

/*
|--------------------------------------------------------------------------
| 商品詳細
|--------------------------------------------------------------------------
*/

Route::get('/product/detail/{id}', [ProductController::class, 'show'])
    ->middleware('auth')
    ->name('product.detail');
    
/**
 * 商品登録処理
 */
Route::post('/product/store', [ProductController::class, 'store'])
    ->middleware('auth')
    ->name('product.store');

/**
 * 商品削除
 */
Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])
    ->middleware('auth')
    ->name('product.delete');

/*
|--------------------------------------------------------------------------
| 商品編集画面
|--------------------------------------------------------------------------
*/

Route::get('/product/edit/{id}', [ProductController::class, 'edit'])
    ->middleware('auth')
    ->name('product.edit');

/*
|--------------------------------------------------------------------------
| 商品更新処理
|--------------------------------------------------------------------------
*/

Route::post('/product/update/{id}', [ProductController::class, 'update'])
    ->middleware('auth')
    ->name('product.update');

/*
|--------------------------------------------------------------------------
| ログアウト（簡易）
|--------------------------------------------------------------------------
*/
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});