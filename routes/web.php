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
route::get('/testconnect', 'DemoController@testconnect')->name('testconnect');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/wall', 'HomeController@wall')->name('wall');

Route::get('/admin', 'DemoController@admin')->name('admin')->middleware('checkadmin');

Route::View('/news', 'news');
Route::get('/load', 'DemoController@load')->name('load');
Route::get('/profile_post/{id}', 'PostController@profilePost')->name('profilePost');
Route::post('/add_post/{id}', 'PostController@addPost')->name('add_post');
Route::get('/test', 'PostController@test')->name('test');
Route::post('/add_comment/{posts_id}/{user_id}', 'PostController@addComment')->name('add_comment');
Route::get('/post/{id}', 'PostController@getPost')->name('post');
Route::post('post/add_comment/{posts_id}/{users_id}', 'PostController@addComment2')->name('add_comment2');
Route::post('/update_user', 'PostController@update')->name('update_user');
Route::get('/delete/{id}', 'PostController@delete')->name('delete');
Route::View('/chat', 'chat')->name('chat');
Route::post('/sendmsg', 'ChatController@sendmsg')->name('sendmsg');
Route::get('/msgload', 'ChatController@loadmsg')->name('msgload');
Route::get('{posts_id}/addLike', 'PostController@addLike')->name('addLike');
Route::View('/test', 'test')->name('test');