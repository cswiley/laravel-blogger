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

if (!function_exists('blog_admin_path')) {
    function blog_admin_path($path = '')
    {
        $base = ['/'];
        $base[] = config('blogger.admin_route');

        if (! empty($path)) {
            $base[] = $path;
        }

        return path_builder($base);
    }
}

if (!function_exists('blog_public_path')) {
    function blog_public_path($path = '')
    {
        $base   = ['/'];
        $base[] = config('blogger.public_route');

        if (!empty($path)) {
            $base[] = $path;
        }

        return path_builder($base);
    }
}

if (!function_exists('blog_edit_path')) {
    function blog_edit_path($idOrSlug)
    {
        $base   = ['/'];
        $base[] = config('blogger.admin_route');
        $base[] = $idOrSlug;
        $base[] = 'edit';

        return path_builder($base);
    }
}
