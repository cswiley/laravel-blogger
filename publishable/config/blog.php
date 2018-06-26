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
    'assets_path'  => '/vendor/cswiley/blogging/assets',

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
    ]
];
