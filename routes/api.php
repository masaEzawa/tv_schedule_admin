<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

// ブログ公開画面のコントローラー
Route::group( ['prefix' => 'event'], function() {

    // ブログ公開画面のコントローラ
    Route::get( 'search',      'Api\Event\EventController@getList' ); // 一覧表示
    Route::get( 'sort',        'Api\Event\EventController@getSort' ); // 一覧表示
});