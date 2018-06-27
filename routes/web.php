<?php

Auth::routes();

Route::delete('api/blog-image', '\Cswiley\Blogger\Controllers\API\BlogImageController@delete');
Route::resource('api/blog-image', '\Cswiley\Blogger\Controllers\API\BlogImageController')->only([
    'create',
    'store'
]);

Route::middleware([
    'web',
    'auth'
])->group(function () {
});
Route::post(config('blog.prefix') . '/preview/{id}', '\Cswiley\Blogger\Controllers\BlogController@preview');
Route::resource(config('blog.prefix'), '\Cswiley\Blogger\Controllers\BlogController');


Route::delete('api/' . config('blog.prefix') .  '/upload', '\Cswiley\Blogger\Controllers\API\BlogController@deleteImage');
Route::post('api/' . config('blog.prefix') . '/upload', '\Cswiley\Blogger\Controllers\API\BlogController@storeImage');
Route::resource('api/' . config('blog.prefix'), '\Cswiley\Blogger\Controllers\API\BlogController');