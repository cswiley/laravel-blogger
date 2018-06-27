<?php

return [

    'middleware' => [
        'auth'
    ],

    /*
    |--------------------------------------------------------------------------
    | The route prefix you wish to use with your blogging installation
    |--------------------------------------------------------------------------
    |
    | specify the domain prefix you would like your users to visit in order
    | to view the Style Guide page
    |
    */
    'prefix'       => 'blog',

    /*
   |--------------------------------------------------------------------------
   | Filesystem Disk
   |--------------------------------------------------------------------------
   |
   | Specify the filesystem disk to use for json storage (filesystems.php)
   |
   |
   */
    'storage_disk' => 'public',

    /*
   |--------------------------------------------------------------------------
   | Asset path location
   |--------------------------------------------------------------------------
   |
   | specify the published asset path location
   |
   |
   */
    'assets_path'  => '/vendor/cswiley/blogger/assets',


    'view_path'  => 'views/vendor/blogger',

    /*
   |--------------------------------------------------------------------------
   | Admin section home
   |--------------------------------------------------------------------------
   */
    'admin_prefix' => 'admin',

    /*
     |--------------------------------------------------------------------------
     | Application stylesheets
     |--------------------------------------------------------------------------
     |
     | Specify your application stylesheets to load
     */
    'stylesheets'  => [
        '/css/app.css',
        'https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.css'
    ],

    /*
    |--------------------------------------------------------------------------
    | Application script
    |--------------------------------------------------------------------------
    |
    | Specify your application scripts to load
    */
    'scripts'      => [
        '/js/manifest.js',
        '/js/vendor.js',
        '/js/app.js',
        'https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.js'
    ]
];
