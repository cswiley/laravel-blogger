<?php

if (!function_exists('blog_assets')) {
    function blog_assets($path, $secure = null)
    {
        $base = config('blogger.assets_path');
        return asset($base . '/' . $path, $secure);
    }
}

if (!function_exists('blog_url')) {
    function blog_url($path = '')
    {
        $base = '/' . config('blogger.prefix');

        if (! empty($path)) {
            $base = $base . '/' . ltrim($path, '/');
        }

        return $base;
    }
}
