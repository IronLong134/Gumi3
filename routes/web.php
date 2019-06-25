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
//DEFAUNT
Route::get('/', function () {
	return view('welcome');
})->name('welcome');
//Test Db
route::get('/testconnect', 'DemoController@testconnect')->name('testconnect');
Auth::routes();


//HOME
Route::get('/home', 'HomeController@index')->name('home')->middleWare('CheckBlockAcount');

//ADMIN


//TEST
Route::View('/test', 'test')->name('test');
Route::get('/test', 'PostController@test')->name('test');
Route::get('/checklike/{post_id}/{user_id}', 'PostController@checkLike')->name('check_like');

//CHANGE USER INFO
Route::post('/update_avatar', 'PostController@update')->name('update_avatar');
Route::post('/update_info/{user_id}', 'DemoController@update_info')->name('update_info');

//POST
//get all post people,
Route::get('/all_people', 'DemoController@allPeople')->name('allPeople')->middleWare('auth');
//post of one user-USER
Route::get('/profile_post/{id}', 'PostController@profilePost')->name('profilePost');
//*****ROUTE TRANG CÁ NHÂN*****
Route::get('/edit_profile/{user_id}', 'DemoController@edit_profile')->name('edit_profile')->middleWare('checkUser');
Route::post('/add_post/{user_id}', 'PostController@addPost')->name('profile_post')->middleWare('checkUser');//TRANG CÁ NHÂN
Route::get('/post/{id}', 'PostController@getPost')->name('post')->middleWare('checkPost')->middleWare('auth');
Route::get('/delete/{id}', 'PostController@delete')->name('delete');
Route::get('/images/{id}', 'DemoController@image')->name('image');
Route::post('/deleteImage', 'DemoController@deleteImage')->name('deleteImage');
Route::post('/updateAvatar', 'DemoController@updateAvatar')->name('updateAvatar');

//LIKE, COMMNENT POST
Route::post('/add_comment/{post_id}/{user_id}', 'PostController@addComment')->name('add_comment');
Route::post('post/add_comment/{post_id}/{user_id}', 'PostController@addComment2')->name('add_comment2');
Route::post('/{post_id}/addLike', 'PostController@addLike')->name('addLike');
Route::post('/delete_cmt', 'PostController@deleteCmt')->name('deleteCmt');


//FEATURE FRIEND
Route::get('/rq_friends/{user_id}', 'DemoController@getRqfriend')->name('rqfriend')->middleWare('checkUser');
Route::get('/send_rq/{friend_id}', 'DemoController@addFriend')->name('addFriend');
Route::post('/send_rq_test/{friend_id}', 'DemoController@addFriend1')->name('addFriend1');
Route::get('/list_friends/{user_id}', 'DemoController@listFriend')->name('list_friend')->middleWare('checkUser');
Route::get('/profile_friend/{friend_id}', 'DemoController@profile_friend')->name('profile_friend')->middleWare('auth')->middleWare('checkBlock');
//BLOCK
Route::get('/block/{user_id}/{friend_id}', 'DemoController@addBlock')->name('add_Block')->middleWare('auth');
Route::get('/delete_block/{user_id}/{friend_id}', 'DemoController@deleteBlock')->name('delete_Block')->middleWare('auth');
Route::get('/list_block/{user_id}', 'DemoController@list_block')->name('list_Block')->middleWare('auth');

//Accept- refure friend
Route::get('/refuse/{sender_id}/{receiver_id}', 'DemoController@refuse')->name('refuse');
Route::post('/refuse_test', 'DemoController@refuse_test')->name('refuse_test');
Route::get('/accept/{user_id}/{friend_id}', 'DemoController@accept')->name('accept');
Route::post('/accept_ajax', 'DemoController@accept_ajax')->name('accept_ajax');// ajax
Route::get('/realtime', 'DemoController@realtime')->name('realtime');
Route::get('/realtime2', 'DemoController@realtime2')->name('realtime2');
//Error
Route::get('/error', 'DemoController@error')->name('error');
//AJAX
//Chat

// Controllers trong namespace "App\Http\Controllers\Admin"
Route::get('/chat', function () {
	return view('chat');
})->name('chat');
Route::get('/test', function () {
	return view('admin');
})->name('test');
Route::get('/test1', 'AdminController@getListBlock')->name('test');


Route::middleware(['auth'])->group(function () {
	Route::get('/chat_friend/{friend_id}', 'ChatController@chat')->name('chat_friend');
	Route::post('/load_chat', 'ChatController@load')->name('load');
	Route::post('/add_msg_ajax', 'ChatController@addMsg')->name('addMsg');
	Route::get('/getMsg', 'ChatController@getListMsg')->name('getMsg');
	Route::get('/list_chat/{user_id}', 'ChatController@listChat')->name('ListChat')->middleWare('checkUser');
	Route::get('/update_listChat', 'ChatController@update_listChat')->name('update_listChat');
	Route::post('/seen', 'ChatController@seen')->name('seen');
	Route::post('/addreport', 'DemoController@addReport')->name('addreport');
});
Route::middleware(['checkadmin'])->group(function () {
	Route::group(['prefix' => 'admin'], function () {
		Route::get('', 'AdminController@admin_report')->name('reports');
		Route::get('update_report', 'AdminController@update_report')->name('update_report');
		Route::get('report_nodelete', 'AdminController@admin_report_nodelete')->name('report_nodelete');
		Route::get('report_delete', 'AdminController@admin_report_delete')->name('report_delete');
		Route::get('members', 'AdminController@admin_member')->name('members');
		Route::post('update_report', 'AdminController@update_report')->name('update_report');
		Route::get('profile_friend/{id}', 'AdminController@profile_user')->name('admin-profile-friend');
		Route::post('block_acount', 'AdminController@block_acount')->name('admin-block-acount');
	});
});
Route::middleware(['CheckBlockAcount2'])->group(function () {
	Route::get('/profile_friend/{friend_id}', 'DemoController@profile_friend')->name('profile_friend')->middleWare('auth')->middleWare('checkBlock');

});

 
   
