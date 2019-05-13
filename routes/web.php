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
    Route::get('/checklike/{post_id}/{user_id}','PostController@checkLike')->name('check_like');
    
    //CHANGE USER INFO
    Route::post('/update_user', 'PostController@update')->name('update_user');
    
    //POST
    //get all post people,
    Route::get('/all_people', 'DemoController@allPeople')->name('allPeople')->middleWare('auth');
    //post of one user-USER
    Route::get('/profile_post/{id}', 'PostController@profilePost')->name('profilePost');
    //*****ROUTE TRANG CÁ NHÂN*****
    Route::post('/add_post/{user_id}', 'PostController@addPost')->name('profile_post')->middleWare('checkUser');//TRANG CÁ NHÂN
    Route::get('/post/{id}', 'PostController@getPost')->name('post')->middleWare('checkPost')->middleWare('auth');
    Route::get('/delete/{id}', 'PostController@delete')->name('delete');
    
    //LIKE, COMMNENT POST
    Route::post('/add_comment/{post_id}/{user_id}', 'PostController@addComment')->name('add_comment');
    Route::post('post/add_comment/{post_id}/{user_id}', 'PostController@addComment2')->name('add_comment2');
    Route::post('/{post_id}/addLike', 'PostController@addLike')->name('addLike');
   
   
    //FEATURE FRIEND
    Route::get('/rq_friends/{user_id}', 'DemoController@getRqfriend')->name('rqfriend')->middleWare('checkUser');
    Route::get('/send_rq/{friend_id}', 'DemoController@addFriend')->name('addFriend');
    Route::get('/list_friends/{user_id}', 'DemoController@listFriend')->name('list_friend')->middleWare('checkUser');
    Route::get('/profile_friend/{friend_id}', 'DemoController@profile_friend')->name('profile_friend')->middleWare('checkFriend')->middleWare('auth');
    
    //Accept- refure friend
    Route::get('/refuse/{sender_id}/{receive_id}', 'DemoController@refuse')->name('refuse');
    Route::get('/accept/{user_id}/{friend_id}', 'DemoController@accept')->name('accept');
   
