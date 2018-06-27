<?php

if (!function_exists('blog_assets')) {
    function blog_assets($path, $secure = null)
    {
        $base = config('blog.assets_path');
        return asset($base . '/' . $path, $secure);
    }
}
