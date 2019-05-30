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
	Route::get('/home', 'HomeController@index')->name('home');
	
	//ADMIN
	Route::get('/admin', 'DemoController@admin')->name('admin')->middleware('checkadmin')->middleWare('checkUser');
	
	
	//MESSEGER - NOT COMPELETE
	Route::View('/chat', 'chat')->name('chat');
	Route::post('/sendmsg', 'ChatController@sendmsg')->name('sendmsg');
	Route::get('/msgload', 'ChatController@loadmsg')->name('msgload');
	
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
	Route::get('/list_friends/{user_id}', 'DemoController@listFriend')->name('list_friend')->middleWare('checkUser');
	Route::get('/profile_friend/{friend_id}', 'DemoController@profile_friend')->name('profile_friend')->middleWare('auth')->middleWare('checkBlock');
	//BLOCK
	Route::get('/block/{user_id}/{friend_id}', 'DemoController@addBlock')->name('add_Block')->middleWare('auth');
	Route::get('/delete_block/{user_id}/{friend_id}', 'DemoController@deleteBlock')->name('delete_Block')->middleWare('auth');
	Route::get('/list_block/{user_id}', 'DemoController@list_block')->name('list_Block')->middleWare('auth');
	
	//Accept- refure friend
	Route::get('/refuse/{sender_id}/{receive_id}', 'DemoController@refuse')->name('refuse');
	Route::get('/accept/{user_id}/{friend_id}', 'DemoController@accept')->name('accept');
	
	//Error
	Route::get('/error', 'DemoController@error')->name('error');
   
