<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/blog', 'SelfMainpageController@index');
//Route::post('/create/preview', 'ArticleController@preview');
Route::get('/create', 'ArticleController@create');
Route::post('/blog', 'ArticleController@store');
Route::post('/blog/{id}/update', 'ArticleController@update');
//Route::post('/blog/article', 'SelfMainpageController@readMore');
Route::get('/blog/article/{id}/edit', 'ArticleController@edit');
Route::get('/blog/article/{id}/delete', 'ArticleController@destory');
Route::get('/blog/article', 'SelfMainpageController@readMore')->middleware('articleReadThrottle');
Route::get('/profile', 'SelfMainpageController@showProfile');
Route::post('/profile', 'SelfMainpageController@saveProfile');
Route::get('/test', 'ArticleController@test');
Route::post('/blog/article/ajaxupload', 'ArticleController@ajaxUpload');
Route::get('/storage/uploads/{id}/{filename}', 'ArticleController@getfile');
Route::get('/tag', 'SelfMainpageController@gettag');
Route::post('/search', 'SelfMainpageController@search');
Route::get('/archives', 'SelfMainpageController@archives');
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Route::get('/',function(){
    return view('index');
});
Route::get('/blank', 'SelfMainpageController@redirectAfterLoginRegister');
    
Route::get('/contact', function () {
    return view('contact',['msg'=>""]);
});

Route::post('/contact', 'SelfMainpageController@contactByUser');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);



Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/home', 'HomeController@index');
    Route::get('password/email', 'Auth\PasswordController@getEmail');
    Route::post('password/email', 'Auth\PasswordController@postEmail');
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('password/reset', 'Auth\PasswordController@postReset');
    Route::get('auth/login', 'Auth\AuthController@getLogin');
    Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::get('auth/logout', 'Auth\AuthController@getLogout');
    Route::get('auth/register', 'Auth\AuthController@getRegister');
    Route::post('auth/register', 'Auth\AuthController@postRegister');

});
