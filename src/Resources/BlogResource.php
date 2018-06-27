<?php

namespace Cswiley\Blogger\Resources;

use Illuminate\Http\Resources\Json\Resource;

class BlogResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $resourceArray = parent::toArray($request);
        $resourceArray['user'] = $this->user;
        return $resourceArray;
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
