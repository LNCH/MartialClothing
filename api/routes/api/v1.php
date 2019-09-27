<?php

Route::get('/ping', function () {
    // Fun little endpoint to test the response
    return response()->json(['pong' => time()]);
});

Route::resource('categories', 'CategoryController');

Route::resource('products', 'ProductController');

Route::group(['prefix' => 'auth'], function () {

    Route::post('register', 'Auth\RegisterController@action');

});
