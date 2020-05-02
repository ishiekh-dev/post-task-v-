<?php

 
use Illuminate\Support\Facades\Route;

Route::group([  
    'prefix' => 'auth' 
], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me'); 
});
 
Route::group([  
    'middleware' => 'auth:api' 
], function ($router) { 
    Route::post('/post', 'PostController@create')->name('store.post'); 
    Route::put('/post/{id}', 'PostController@update')->name('update.post');
    Route::delete('/post/{id}', 'PostController@delete')->name('destroy.post');
});
Route::get('post/{id}', 'PostController@show')->name('show.post');
Route::get('/post', 'PostController@index')->name('index.post');
 
Route::get('/cache', function () {

    return Cache::get('posts');

});