<?php

$route = config('blogger.route');

Route::delete("api/{$route}-image", '\Cswiley\Blogger\Controllers\API\BlogImageController@delete');
Route::resource("api/{$route}-image", '\Cswiley\Blogger\Controllers\API\BlogImageController')->only([
    'create',
    'store'
]);

Route::post("{$route}/preview/{id}", '\Cswiley\Blogger\Controllers\BlogController@preview');
Route::resource($route, '\Cswiley\Blogger\Controllers\BlogController');

Route::resource("api/{$route}", '\Cswiley\Blogger\Controllers\API\BlogController');
