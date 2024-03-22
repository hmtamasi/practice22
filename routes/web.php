<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
// "Route"というツールを使うために必要な部品を取り込んでいます。
use App\Http\Controllers\ProductController;
// ProductControllerに繋げるために取り込んでいます
use Illuminate\Support\Facades\Auth;
// "Auth"という部品を使うために取り込んでいます。この部品はユーザー認証（ログイン）に関する処理を行います

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

Route::get('/', function () {
    // ウェブサイトのホームページ（'/'のURL）にアクセスした場合のルートです
    if (Auth::check()) {
        // ログイン状態ならば
        return redirect()->route('list');
        // 商品一覧ページ（ProductControllerのindexメソッドが処理）へリダイレクトします
    } else {
        // ログイン状態でなければ
        return redirect()->route('login');
        //　ログイン画面へリダイレクトします
    }
});

Auth::routes();

// Auth::routes();はLaravelが提供している便利な機能で
// 一般的な認証に関するルーティングを自動的に定義してくれます
// この一行を書くだけで、ログインやログアウト
// パスワードのリセット、新規ユーザー登録などのための
// ルートが作成されます。
//　つまりログイン画面に用意されたビューのリンク先がこの1行で済みます

Route::group(['middleware' => 'auth'], function () {
    Route::resource('products', ProductController::class);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/list', [App\Http\Controllers\ProductController::class, 'showList'])->name('list');

Route::get('/create', [App\Http\Controllers\ProductController::class, 'showCreate'])->name('create');

Route::get('/show/{id}', [App\Http\Controllers\ProductController::class, 'showShow'])->name('show');

Route::get('/edit/{id}', [App\Http\Controllers\ProductController::class, 'showEdit'])->name('edit');

Route::PUT('/update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('update');

Route::POST('/destroy/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('destroy');

Route::post('/store',[App\Http\Controllers\ProductController::class, 'store'])->name('store');

Route::post('/regist',[App\Http\Controllers\ProductController::class, 'registSubmit'])->name('regist');

Route::get('hello', 'HelloController@index');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
