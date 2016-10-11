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
	if (Auth::check()) {
		
   		return redirect()->guest('quan-ly-tai-khoan');
	}	
	return redirect()->guest('login');
});
Route::get('/home', function () {
	if (Auth::check()) {
		
   		return redirect()->guest('quan-ly-tai-khoan');
	}	
	return redirect()->guest('login');
});

Route::get('/login-error', function () {
	return view('auth.error');
});


Route::post('/ma-kich', function () {
	return view('auth.error');
});


Route::auth();

Route::get('/quan-ly-tai-khoan', [
    'as' => 'home', 
    'uses' => 'HomeController@index'
]);
Route::get('/access-token', [
	'as' => 'home', 
    'uses' => 'HomeController@AccessToken'
	]);
Route::post('/change-pass', [
	'as' => 'home', 
    'uses' => 'HomeController@ChangePass'
	]);
Route::get('/gui-tin-nhan', [
	'as' => 'sentMessage', 
    'uses' => 'HomeController@SentMessage'
	]);
Route::get('/dang-bai-len-nhom', [
	'as' => 'postGroup', 
    'uses' => 'HomeController@PostGroup'
	]);

Route::get('/post-image', [
	'as' => 'postGroup', 
    'uses' => 'HomeController@PostImage'
	]);

Route::get('/dang-bai-len-tuong', [
	'as' => 'postGroup', 
    'uses' => 'HomeController@PostToWall'
	]);

Route::post('/check-phone', 'HomeController@CheckPhone');

Route::get('/up-top-bai-viet', [
	'as' => 'upTop', 
    'uses' => 'HomeController@UpTop'
	]);

Route::get('/yeu-cau-ket-ban', [
	'as' => 'tools', 
    'uses' => 'HomeController@AddFriend'
	]);
Route::get('/moi-thich-trang', [
	'as' => 'tools', 
    'uses' => 'HomeController@LikePage'
	]);
Route::get('/moi-su-kien', [
	'as' => 'tools', 
    'uses' => 'HomeController@AddEvent'
	]);
Route::get('/huy-ket-ban', [
	'as' => 'tools', 
    'uses' => 'HomeController@Unfriend'
	]);
Route::get('/tham-gia-nhom', [
	'as' => 'tools', 
    'uses' => 'HomeController@AddGroup'
	]);
Route::get('/them-ban-vao-nhom', [
	'as' => 'tools', 
    'uses' => 'HomeController@AddFriendToGroup'
	]);
Route::get('/keo-nhom', [
	'as' => 'tools', 
    'uses' => 'HomeController@ToGroup'
	]);
Route::get('/tai-khoan-ngan-hang', [
	'as' => 'tools', 
    'uses' => 'HomeController@ThanhToan'
	]);



Route::post('/addAcc/', 'HomeController@addAcc');
Route::get('checkpoint/{random}', 'HomeController@CheckPoint');

//controller json
Route::get('/delAcc/{uid}', 'JSRequestController@delAcc');


// Route::get('/myLoop/{postArr}', 'JSRequestController@myLoop');
Route::post('/myLoop/', 'JSRequestController@myLoop');

Route::get('/lay-ds-bai/{poster}/{timeketthuc}/{timebatdau}', 'JSRequestController@dsBai');



