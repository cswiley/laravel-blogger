<?php

if (!function_exists('blog_assets')) {
    function blog_assets($path, $secure = null)
    {
        $base = config('blogger.assets_path');
        return asset($base . '/' . $path, $secure);
    }
}

if (! function_exists('path_builder')) {
    function path_builder($path)
    {
        return preg_replace('/\/[\/]+/', '/', implode('/', $path));
    }

}

if (!function_exists('blog_path')) {
    function blog_path($path = '')
    {
        $base = ['/'];
        $base[] = config('blogger.route');

        if (! empty($path)) {
            $base[] = $path;
        }

        return path_builder($base);
    }
}

if (!function_exists('blog_url')) {
    function blog_url($path = '')
    {
        $base = ['/'];
        $base[] = config('blogger.route');

        if (!empty($path)) {
            $base[] = $path;
        }

        return url(path_builder($base));
    }
}
