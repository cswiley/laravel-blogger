<?php

namespace Cswiley\Blogger\Resources;

use Cswiley\Blogger\Models\Blog;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BlogCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function with($request)
    {
        return [
            'meta' => [
                'visibility_options' => Blog::$visibilityLookup
            ]
        ];
    }
}
