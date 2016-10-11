<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    if(session("uid"))
    {
        return redirect('index');
    }
     return view('loginv2');
});

Route::get('index', [
    'as' => 'home', 
    'uses' => 'RouteController@home']);

Route::get('data/{uid}', 'JSRequestController@getData');

Route::post('saveAcc', 'JSRequestController@saveAcc');
Route::post('updatepage', 'JSRequestController@updatepage');

Route::get('/changeDef/{uid}/{pageid}', 'JSRequestController@changeDef');
Route::get('checkpoint', 'RouteController@checkpoint');
Route::get('profile', [
    'as' => 'profile', 
    'uses' => 'RouteController@profile'
]);

Route::get('feed', [
    'as' => 'feed', 
    'uses' => 'RouteController@trendingp'
]);

Route::get('video', [
    'as' => 'video', 
    'uses' => 'RouteController@video'
]);

Route::get('youtube', [
    'as' => 'youtube', 
    'uses' => 'RouteController@youtube'
]);

Route::get('active', [
    'as' => 'active', 
    'uses' => 'RouteController@active'
]);

Route::get('getdatatk', 'JSRequestController@getDataActive');

Route::post('kich', 'RouteController@kich');

Route::get('dataActive', 'RouteController@dataActive');
Route::get('mailActive', 'RouteController@mailActive');

Route::get('logout', 'RouteController@logout');

// Route::get('trendingp', 'RouteController@trendingp');

Route::post('bookmark', 'JSRequestController@bookmark');

Route::get('getbookmark', 'JSRequestController@getbookmark');

Route::get('getbookmarkyt', 'JSRequestController@getBookyt');

Route::get('discover/{pageid}', 'RouteController@dicovery');

Route::get('discover/isbookmark/{pageid}', 'JSRequestController@isbookmark');

Route::get('discover/unbookmark/{pageid}', 'JSRequestController@unbookmark');

Route::get('unbookmark/{pageid}', 'JSRequestController@unbookmark');

Route::post('discover/bookmark', 'JSRequestController@bookmark');

Route::get('getfan', 'JSRequestController@getfan');

Route::post('bookmarkyt', 'JSRequestController@bookmarkyt');

Route::post('discoveryt/bookmarkyt', 'JSRequestController@bookmarkyt');

Route::get('unbookmarkyt/{pageid}', 'JSRequestController@unbookmarkyt');

Route::get('discoveryt/unbookmarkyt/{pageid}', 'JSRequestController@unbookmarkyt');

Route::get('discoveryt/{channelId}', 'RouteController@discoveryt');

Route::get('getvideourl/{idvideo}', 'JSRequestController@getvideourl');

Route::get('discoveryt/getvideourl/{idvideo}', 'JSRequestController@getvideourl');

Route::post('login-acc', 'JSRequestController@loginAcc');

Route::get('check-acc', 'JSRequestController@checkAcc');

Route::post('register-acc', 'JSRequestController@registerAcc');

Route::get('/home', 'HomeController@index');

//lay token tam thoi da luu layTokenTam
Route::get('/lay-token', 'RouteController@layTokenTam');
Route::get('getdatatk2', 'JSRequestController@getDataActive2');