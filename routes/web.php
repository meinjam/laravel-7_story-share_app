<?php

use Illuminate\Support\Facades\Route;

Route::get( '/', function () {
    return view( 'welcome' );
} );

Auth::routes();

Route::get( '/profile', 'HomeController@profile' )->name( 'home' );
Route::get( '/profile/edit/{id}/info', 'ProfileController@show' )->name( 'edit.profile.info' );
Route::post( '/profile/update/info', 'ProfileController@updateinfo' )->name( 'update.profile.info' );
Route::get( '/profile/edit/{id}/picture', 'ProfileController@edit_pro_pic' )->name( 'edit.profile.picture' );
Route::post( '/profile/update/picture', 'ProfileController@update_pro_pic' )->name( 'update.profile.picture' );
Route::get( '/profile/update/{id}/password', 'ProfileController@updatepassword' )->name( 'edit.profile.password' );
Route::post( '/profile/update/password', 'ProfileController@updatepasswordstore' )->name( 'update.profile.password' );
