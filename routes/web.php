<?php

Route::delete('api/' . config('blogger.prefix') . '-image', '\Cswiley\Blogger\Controllers\API\BlogImageController@delete');
Route::resource('api/' . config('blogger.prefix') . '-image', '\Cswiley\Blogger\Controllers\API\BlogImageController')->only([
    'create',
    'store'
]);

Route::post(config('blogger.prefix') . '/preview/{id}', '\Cswiley\Blogger\Controllers\BlogController@preview');
Route::resource(config('blogger.prefix'), '\Cswiley\Blogger\Controllers\BlogController');


Route::delete('api/' . config('blogger.prefix') . '/upload', '\Cswiley\Blogger\Controllers\API\BlogController@deleteImage');
Route::post('api/' . config('blogger.prefix') . '/upload', '\Cswiley\Blogger\Controllers\API\BlogController@storeImage');
Route::resource('api/' . config('blogger.prefix'), '\Cswiley\Blogger\Controllers\API\BlogController');
