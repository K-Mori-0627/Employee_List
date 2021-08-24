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

Route::get('/', function () {
    return view('welcome');
});

//----------------------------------------------
// ユーザー側画面
//----------------------------------------------
Route::namespace('User')->prefix('user')->name('user.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => false,
        'reset'    => false,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:user')->group(function () {
        // ホーム画面
        Route::resource('home', 'HomeController')
             ->only(['index']);

        // お知らせ一覧画面
        Route::resource('information', 'InformationController')
             ->only(['index']);

        // メンバーリスト画面
        Route::resource('employee', 'EmployeeController')
             ->only(['index']);

        // プロフィール画面
        Route::resource('profile', 'ProfileController')
             ->only(['show', 'edit', 'update']);

        // パスワード変更画面
        Route::resource('password', 'PasswordController')
             ->only(['index', 'update']);

    });
});

//----------------------------------------------
// 管理者側画面
//----------------------------------------------
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:admin')->group(function () {
        // ホーム画面
        Route::resource('home', 'HomeController')
             ->only(['index', 'edit', 'update', 'destroy']);
        Route::get('/admin/home/{home}/search', 'HomeController@search')
             ->name('home.search');

        // お知らせ設定画面
        Route::resource('information', 'InformationController')
             ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
        Route::get('/admin/information/{information}/search', 'InformationController@search')
             ->name('information.search');

        // メンバー設定画面
        Route::resource('employee', 'EmployeeController')
             ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
        Route::get('/admin/employee/{employee}/search', 'EmployeeController@search')
             ->name('employee.search');

    });

});
