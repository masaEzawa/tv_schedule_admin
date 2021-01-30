<?php

use Illuminate\Support\Facades\Route;

// login画面に画面遷移
Route::get( '/', function(){
    return redirect( 'auth/login' );
});

// login画面に画面遷移
Route::get( '/auth', function(){
    return redirect( 'auth/login' );
});

// Auth::routes();
Route::prefix('auth')->group(function () {
    Route::get( 'login',  [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'] ); // TOP
	Route::post( 'login', [App\Http\Controllers\Auth\LoginController::class, 'postLogin'] ); // TOP
	Route::get( 'logout', [App\Http\Controllers\Auth\LoginController::class, 'getLogout'] ); // 
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group( ['middleware' => ['auth']], function() {
    // TOP画面のコントローラー
    Route::prefix('top')->group(function () {
        Route::post( 'eventCreate',   [App\Http\Controllers\Top\TopController::class, 'postEventCreate'] )->name('top.eventCreate'); // イベント登録
        Route::get( 'index',          [App\Http\Controllers\Top\TopController::class, 'getList'] ); // TOP
            
        Route::get( 'eventEdit/{id}', [App\Http\Controllers\Top\TopController::class, 'getEventEdit'] ); // イベント編集
        Route::post( 'eventEdit',     [App\Http\Controllers\Top\TopController::class, 'postEventEdit'] )->name('top.eventEdit');; // イベント編集
        Route::get( '/',              [App\Http\Controllers\Top\TopController::class, 'getList'] ); // TOP
    });

    // TV画面のコントローラー
    Route::prefix('tv')->group(function () {
        // TV予約画面のコントローラ
        Route::prefix('tv_reserve')->group(function () {
            Route::get( 'list',        [App\Http\Controllers\Tv\TvReserve\MainController::class, 'getList'] ); // TV番組
            Route::get( 'sort',        [App\Http\Controllers\Tv\TvReserve\MainController::class, 'getSort'] )->name('tv_reserve.sort'); // TV番組
            Route::get( 'create',      [App\Http\Controllers\Tv\TvReserve\MainController::class, 'getCreate'] ); // TV番組
            Route::post( 'create',     [App\Http\Controllers\Tv\TvReserve\MainController::class, 'postCreate'] )->name('tv_reserve.create'); // TV番組
            Route::get( 'edit/{id}',   [App\Http\Controllers\Tv\TvReserve\MainController::class, 'getEdit'] ); // TV番組
            Route::post( 'edit/{id}',  [App\Http\Controllers\Tv\TvReserve\MainController::class, 'postEdit'] )->name('tv_reserve.edit'); // TV番組
            Route::get( 'detail/{id}', [App\Http\Controllers\Tv\TvReserve\MainController::class, 'getDetail'] )->name('tv_reserve.detail'); // TV番組
            Route::get( 'delete/{id}', [App\Http\Controllers\Tv\TvReserve\MainController::class, 'getDelete'] )->name('tv_reserve.delete'); // TV番組
            Route::get( 'index',       [App\Http\Controllers\Tv\TvReserve\MainController::class, 'getIndex'] ); // TV番組
        });
    });

    // イベント画面のコントローラー
    Route::prefix('event')->group(function () {
        Route::get( 'list',          [App\Http\Controllers\Event\EventController::class, 'getList'] ); // イベント
        Route::get( 'sort',          [App\Http\Controllers\Event\EventController::class, 'getSort'] )->name('event.sort'); // イベント
        Route::get( 'create',        [App\Http\Controllers\Event\EventController::class, 'getCreate'] ); // イベント
        Route::post( 'create',       [App\Http\Controllers\Event\EventController::class, 'postCreate'] )->name('event.create'); // イベント
        Route::get( 'edit/{id}',     [App\Http\Controllers\Event\EventController::class, 'getEdit'] ); // イベント
        Route::post( 'edit/{id}',    [App\Http\Controllers\Event\EventController::class, 'postEdit'] )->name('event.edit'); // イベント
        Route::get( 'detail/{id}',   [App\Http\Controllers\Event\EventController::class, 'getDetail'] )->name('event.detail'); // イベント
        Route::get( 'delete/{id}',   [App\Http\Controllers\Event\EventController::class, 'getDelete'] )->name('event.delete'); // イベント
        Route::post( 'upload_image', [App\Http\Controllers\Event\EventController::class, 'postUploadImage'] )->name('event.uploadImage'); // イベント
        Route::get( 'index',         [App\Http\Controllers\Event\EventController::class, 'getIndex'] ); // イベント
    });

    // その他画面のコントローラー
    Route::prefix('other')->group(function () {
        // アカウントのコントローラ
        Route::prefix('account')->group(function () {
            Route::get( 'list',        [App\Http\Controllers\Other\AccountController::class, 'getList'] ); // アカウント
            Route::get( 'sort',        [App\Http\Controllers\Other\AccountController::class, 'getSort'] )->name('account.sort'); // アカウント
            Route::get( 'create',      [App\Http\Controllers\Other\AccountController::class, 'getCreate'] ); // アカウント
            Route::post( 'create',     [App\Http\Controllers\Other\AccountController::class, 'postCreate'] )->name('account.create'); // アカウント
            Route::get( 'edit/{id}',   [App\Http\Controllers\Other\AccountController::class, 'getEdit'] ); // アカウント
            Route::post( 'edit/{id}',  [App\Http\Controllers\Other\AccountController::class, 'postEdit'] )->name('account.edit'); // アカウント
            Route::get( 'detail/{id}', [App\Http\Controllers\Other\AccountController::class, 'getDetail'] )->name('account.detail'); // アカウント
            Route::get( 'delete/{id}', [App\Http\Controllers\Other\AccountController::class, 'getDelete'] )->name('account.delete'); // アカウント
            Route::get( 'index',       [App\Http\Controllers\Other\AccountController::class, 'getIndex'] ); // アカウント
        });
    });
});
