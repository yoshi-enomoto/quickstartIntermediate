<?php

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

// ゲストユーザ用のランディングページ
Route::get('/', function () {
    return view('welcome');
});

// 下記２つは『php artisan make:auth』すると自動で生成される。
    // 認証ルート
    Auth::routes();

    // ログイン後に表示されるページ（設定を変える前）
    Route::get('/home', 'HomeController@index')->name('home');

    // tasks
    Route::resource('/tasks', 'TaskController', ['except' => ['create', 'show', 'edit', 'update']]);
