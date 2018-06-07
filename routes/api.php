<?php

Route::post('login', 'Auth\LoginController@login');
Route::post('register', 'Auth\RegisterController@register');
Route::post('logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('offers', 'Api\OfferController@index');
    Route::get('offers/{offer}', 'Api\OfferController@show');
    Route::post('offers', 'Api\OfferController@store');
    Route::put('offers/{offer}', 'Api\OfferController@update');
    Route::delete('offers/{offer}', 'Api\OfferController@delete');
});
