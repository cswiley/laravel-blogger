<?php

namespace Cswiley\Blogger\Repositories;

use Carbon\Carbon;
use Cswiley\Blogger\Models\Blog;

class BlogRepository
{
    protected $query;
    protected $model;

    public function __construct(Blog $blog)
    {
        $this->model = $blog;
        $this->query = $blog;
    }

    public function onlyActive()
    {
        $this->query = $this->query->where('published_at', '<', Carbon::now())->where('visibility', Blog::VISIBILITY_PUBLIC);

        return $this;
    }

    public function idOrSlug($value)
    {
        $this->query = $this->query->where('id', $value)->orWhere('slug', $value);

        return $this;
    }

    public function execute()
    {
        $query       = $this->query;
        $this->query = $this->model;

        return $query;
    }

}