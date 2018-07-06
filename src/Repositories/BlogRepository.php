<?php

namespace Cswiley\Blogger\Repositories;

use Carbon\Carbon;
use Cswiley\Blogger\Models\Blog;

class BlogRepository extends Repository
{
    public function __construct(Blog $blog)
    {
        parent::__construct($blog);
    }

    public function onlyActive()
    {
        $this->query = $this->query->where(function ($query) {
            $query->where('published_at', '<', Carbon::now())->where('visibility', Blog::VISIBILITY_PUBLIC);
        });

        return $this;
    }

    public function idOrSlug($value)
    {
        $this->query = $this->query->where(function ($query) use ($value) {
            $query->where('id', $value)->orWhere('slug', $value);
        });

        return $this;
    }
}