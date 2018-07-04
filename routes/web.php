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
Route::get('/', "\App\Http\Controllers\LoginController@index");

Route::group(['middleware'=>'user_login'], function(){
    // 文章
    Route::get('/posts/create', 'PostController@create');
    Route::post('/posts/{post}/delete', 'PostController@delete');
    Route::post('/posts', 'PostController@store');
    Route::get('/posts/{post}/edit', '\App\Http\Controllers\PostController@edit');
    Route::post('/posts/img/upload', '\App\Http\Controllers\PostController@imageUpload');
    Route::post('/posts/comment', '\App\Http\Controllers\PostController@comment');
    Route::get('/posts/{post}/zan', '\App\Http\Controllers\PostController@zan');
    Route::get('/posts/{post}/unzan', '\App\Http\Controllers\PostController@unzan');

    // 个人主页
    Route::get('/user/{user}', '\App\Http\Controllers\UserController@show');
    Route::post('/user/{user}/fan', '\App\Http\Controllers\UserController@fan');
    Route::post('/user/{user}/unfan', '\App\Http\Controllers\UserController@unfan');

    // 个人设置
    Route::get('/user/me/setting', '\App\Http\Controllers\UserController@setting');
    Route::post('/user/me/setting', '\App\Http\Controllers\UserController@settingStore');

    // 专题
    Route::get('/topic/{topic}', '\App\Http\Controllers\TopicController@show');
    Route::get('/topic/{topic}/submit', '\App\Http\Controllers\TopicController@submit');

    // 通知
    Route::get('/notices', '\App\Http\Controllers\NoticeController@index');
});
Route::get('/posts', 'PostController@index');
Route::get('/posts/search', 'PostController@search');
Route::get('/posts/{post}', 'PostController@show');

Route::get('/login', "LoginController@index");
Route::post('/login', "LoginController@login");
Route::get('/logout', "LoginController@logout");

Route::get('/register', "RegisterController@index");
Route::post('/register', "RegisterController@register");

