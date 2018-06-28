<?php

if (!function_exists('blog_assets')) {
    function blog_assets($path, $secure = null)
    {
        $base = config('blogger.assets_path');
        return asset($base . '/' . $path, $secure);
    }
}

if (!function_exists('blog_path')) {
    function blog_path($path = '')
    {
        $base = '/' . config('blogger.route');

        if (! empty($path)) {
            $base = $base . '/' . ltrim($path, '/');
        }

        return $base;
    }
}

if (!function_exists('blog_url')) {
    function blog_url($path = '')
    {
        $base = '/' . config('blogger.route');

        if (!empty($path)) {
            $base = $base . '/' . ltrim($path, '/');
        }

        return url($base);
    }
}
