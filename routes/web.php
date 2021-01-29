<?php

// login画面に画面遷移
Route::get( '/', function(){
    return redirect( 'auth/login' );
});

// login画面に画面遷移
Route::get( '/auth', function(){
    return redirect( 'auth/login' );
});


// 認証階層
Route::group( ['prefix' => 'auth'], function() {
	Route::get( 'login', 'Auth\LoginController@showLoginForm' ); // TOP
	Route::post( 'login', 'Auth\LoginController@postLogin' ); // TOP
	Route::get( 'logout', 'Auth\LoginController@getLogout' ); // 
});

// TODO: 適当なコメントを入れること
// ○○階層
Route::group( ['middleware' => ['auth']], function() {

	// TOP画面のコントローラー
    Route::group( ['prefix' => 'top'], function() {
        // Route::get( 'eventCreate', 'Top\TopController@postEventCreate' ); // イベント登録
        Route::post( 'eventCreate', 'Top\TopController@postEventCreate' ); // イベント登録
        Route::get( 'index', 'Top\TopController@getList' ); // TOP
          
        Route::get( 'eventEdit/{id}', 'Top\TopController@getEventEdit' ); // イベント編集
        Route::post( 'eventEdit', 'Top\TopController@postEventEdit' ); // イベント編集
        Route::get( '/', 'Top\TopController@getList' ); // TOP
    });
    
    // TV画面のコントローラー
    Route::group( ['prefix' => 'tv'], function() {
        // TV予約画面のコントローラ
        Route::group( ['prefix' => 'tv_reserve'], function() {
        
            Route::get( 'list',      'Tv\TvReserve\MainController@getList' ); // TV番組
            Route::get( 'sort',        'Tv\TvReserve\MainController@getSort' ); // TV番組
            Route::get( 'create',      'Tv\TvReserve\MainController@getCreate' ); // TV番組
            Route::put( 'create',              'Tv\TvReserve\MainController@putCreate' ); // TV番組
            Route::get( 'edit/{id}',          'Tv\TvReserve\MainController@getEdit' ); // TV番組
            Route::put( 'edit/{id}',        'Tv\TvReserve\MainController@putEdit' ); // TV番組
            Route::get( 'detail/{id}',      'Tv\TvReserve\MainController@getDetail' ); // TV番組
            Route::get( 'delete/{id}',      'Tv\TvReserve\MainController@getDelete' ); // TV番組
            // Route::get( 'csv',           'Tv\TvReserve\MainController@getCsv' ); // TV番組
            Route::get( 'index',            'Tv\TvReserve\MainController@getIndex' ); // TV番組
        });
    });

    // イベント画面のコントローラー
    Route::group( ['prefix' => 'event'], function() {
        Route::get( 'list',      'Event\EventController@getList' ); // イベント
        Route::get( 'sort',        'Event\EventController@getSort' ); // イベント
        Route::get( 'create',      'Event\EventController@getCreate' ); // イベント
        Route::put( 'create',      'Event\EventController@putCreate' ); // イベント
        Route::get( 'edit/{id}',   'Event\EventController@getEdit' ); // イベント
        Route::put( 'edit/{id}',   'Event\EventController@putEdit' ); // イベント
        Route::get( 'detail/{id}', 'Event\EventController@getDetail' ); // イベント
        Route::get( 'delete/{id}', 'Event\EventController@getDelete' ); // イベント
        Route::post( 'upload_image',      'Event\EventController@postUploadImage' ); // イベント
        // Route::get( 'csv',         'Event\EventController@getCsv' ); // イベント
        Route::get( 'index',       'Event\EventController@getIndex' ); // イベント
    });

    // その他画面のコントローラー
    Route::group( ['prefix' => 'other'], function() {
        // アカウントのコントローラ
        Route::group( ['prefix' => 'account'], function() {
        
            Route::get( 'list',      'Other\AccountController@getList' ); // アカウント
            Route::get( 'sort',        'Other\AccountController@getSort' ); // アカウント
            Route::get( 'create',      'Other\AccountController@getCreate' ); // アカウント
            Route::put( 'create',      'Other\AccountController@putCreate' ); // アカウント
            Route::get( 'edit/{id}',   'Other\AccountController@getEdit' ); // アカウント
            Route::put( 'edit/{id}',   'Other\AccountController@putEdit' ); // アカウント
            Route::get( 'detail/{id}', 'Other\AccountController@getDetail' ); // アカウント
            Route::get( 'delete',      'Other\AccountController@getDelete' ); // アカウント
            // Route::get( 'csv',         'Other\AccountController@getCsv' ); // アカウント
            Route::get( 'index',       'Other\AccountController@getIndex' ); // アカウントs
        });
    });
        
});
