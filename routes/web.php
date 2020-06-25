<?php

use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get( '/', 'FrontendController@index' )->name('homepage');
Route::get('/story/create', 'StoryController@create')->name('create.story');
Route::get('/search', 'FrontendController@search')->name('search.all');
Route::get( '/story/{slug}', 'FrontendController@single_story' )->name('single.story');
Route::get('/category/create', 'CategoryController@create')->name('create.category')->middleware('auth');
Route::get( '/category/{name}', 'CategoryController@show' )->name('show.category');
Route::get('/tag/create', 'TagController@create')->name('create.tag')->middleware('auth');
Route::get('/tag/{name}', 'TagController@show')->name('show.tag');
Route::post('/comment/{post_id}', 'CommentController@store')->name('store.comment');
Route::get('/comment/{id}/delete', 'CommentController@destroy')->name('delete.comment')->middleware('auth');
Route::get( '/contact', 'FrontendController@contact' )->name('contact');

// Admins Routes
Route::group(['prefix' => 'admin','middleware'=>'admin'], function () {
    Route::get( '/', 'AdminController@index' )->name( 'admin.homepage' );
    Route::get( '/all-users', 'AdminController@users' )->name( 'admin.all-users' );
    Route::get('/search-user', 'ProfileController@search')->name('search.users');
    Route::get( '/all-admins', 'AdminController@admins' )->name( 'admin.all-admins' );
    // Route::get('/search-user', 'ProfileController@search')->name('search.users');
    Route::get('/search-stories', 'AdminController@search')->name('search.stories');
    Route::get('/comments', 'CommentController@index')->name('all.comments');
    Route::get('/add-admin', 'ProfileController@create')->name('create.admin');
    Route::post('/add-admin', 'ProfileController@store')->name('store.admin');
});

Auth::routes();

// Profile Routes
Route::group(['prefix' => 'profile'], function () {
    Route::get( '/{slug}', 'ProfileController@index' )->name( 'profile' );
    Route::get( '/edit/{slug}/info', 'ProfileController@edit_details' )->name( 'edit.profile.info' )->middleware('auth');
    Route::post( '/update/info', 'ProfileController@updateinfo' )->name( 'update.profile.info' )->middleware('auth');
    Route::get( '/edit/{slug}/picture', 'ProfileController@edit_pro_pic' )->name( 'edit.profile.picture' )->middleware('auth');
    Route::post( '/update/picture', 'ProfileController@update_pro_pic' )->name( 'update.profile.picture' )->middleware('auth');
    Route::get( '/update/{slug}/password', 'ProfileController@updatepassword' )->name( 'edit.profile.password' )->middleware('auth');
    Route::post( '/update/password', 'ProfileController@updatepasswordstore' )->name( 'update.profile.password' )->middleware('auth');
    Route::get('/{slug}/make-admin', 'ProfileController@admin')->name('make.admin')->middleware('admin');
    Route::get('/{slug}/remove-admin', 'ProfileController@remove_admin')->name('remove.admin')->middleware('admin');
    Route::get('/{slug}/delete', 'ProfileController@destroy')->name('delete.user')->middleware('admin');
});

// Tag Routes
Route::group(['prefix' => 'tag', 'middleware'=>'auth'], function () {
    // Route::get('/create', 'TagController@create')->name('create.tag');
    Route::post('/create', 'TagController@store')->name('store.tag');
});

// Category Routes
Route::group(['prefix' => 'category', 'middleware'=>'auth'], function () {
    // Route::get('/create', 'CategoryController@create')->name('create.category');
    Route::post('/create', 'CategoryController@store')->name('store.category');
});

// Stories Routes
Route::group(['prefix' => 'story', 'middleware'=>'auth'], function () {
    // Route::get('/create', 'StoryController@create')->name('create.story');
    Route::post('/create', 'StoryController@store')->name('store.story');
    Route::get('/{slug}/delete', 'StoryController@destroy')->name('delete.story');
    Route::get('/{slug}/edit', 'StoryController@edit')->name('edit.story');
    Route::post('/{slug}/update', 'StoryController@update')->name('update.story');
    Route::get('/{slug}/block', 'StoryController@block')->name('block.story')->middleware('admin');
    Route::get('/{slug}/unblock', 'StoryController@unblock')->name('unblock.story')->middleware('admin');
});