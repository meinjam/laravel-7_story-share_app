<?php

use Illuminate\Support\Facades\Route;

Route::get( '/', function () {
    return view( 'frontend.home' );
} );

Route::get( '/admin', function () {
    return view( 'admin.home' );
} )->middleware( 'admin' );

Auth::routes();

Route::get( '/profile/{id}', 'ProfileController@index' )->name( 'profile' );
Route::get( '/profile/edit/{id}/info', 'ProfileController@edit_details' )->name( 'edit.profile.info' )->middleware('auth');
Route::post( '/profile/update/info', 'ProfileController@updateinfo' )->name( 'update.profile.info' )->middleware('auth');
Route::get( '/profile/edit/{id}/picture', 'ProfileController@edit_pro_pic' )->name( 'edit.profile.picture' )->middleware('auth');
Route::post( '/profile/update/picture', 'ProfileController@update_pro_pic' )->name( 'update.profile.picture' )->middleware('auth');
Route::get( '/profile/update/{id}/password', 'ProfileController@updatepassword' )->name( 'edit.profile.password' )->middleware('auth');
Route::post( '/profile/update/password', 'ProfileController@updatepasswordstore' )->name( 'update.profile.password' )->middleware('auth');
