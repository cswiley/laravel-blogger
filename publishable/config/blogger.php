<?php

return [

    'middleware'        => [
        'auth'
    ],

    /*
    |--------------------------------------------------------------------------
    | The route prefix you wish to use with your blogging installation
    |--------------------------------------------------------------------------
    |
    */
    'admin_route'       => 'blog',
    'public_route'      => 'blog',

    /*
     |--------------------------------------------------------------------------
     | Resource Page Titles
     |--------------------------------------------------------------------------
     |
     */
    'title'             => 'post',
    'title_plural'      => 'posts',

    /*
   |--------------------------------------------------------------------------
   | Filesystem Disk
   |--------------------------------------------------------------------------
   |
   | Specify the filesystem disk to use for json storage (filesystems.php)
   |
   |
   */
    'storage_disk'      => env('FILESYSTEM_BLOG_DISK', 'public'),
    'storage_directory' => 'posts',

    /*
    |--------------------------------------------------------------------------
    | Asset path location
    |--------------------------------------------------------------------------
    |
    | Specify the published asset path location
    |
    |
    */
    'assets_path'       => '/vendor/cswiley/blogger/assets',
    'view_path'         => '/vendor/blogger',

    /*
     |--------------------------------------------------------------------------
     | Admin Menu Links
     |--------------------------------------------------------------------------
     |
     */
    'menu'              => [],

    /*
     |--------------------------------------------------------------------------
     | Application stylesheets
     |--------------------------------------------------------------------------
     |
     | Specify your application stylesheets to load
     */
    'stylesheets'       => [
        '/css/app.css',
    ],

    /*
    |--------------------------------------------------------------------------
    | Application script
    |--------------------------------------------------------------------------
    |
    | Specify your application scripts to load
    */
    'scripts'           => [
        '/js/manifest.js',
        '/js/vendor.js',
        '/js/app.js',
    ]
];
