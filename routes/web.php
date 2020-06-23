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
Route::get( '/contact', 'FrontendController@contact' )->name('contact');

Route::get( '/admin', function () {
    return view( 'admin.home' );
} )->middleware( 'admin' );

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
});