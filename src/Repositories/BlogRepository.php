<?php
namespace Cswiley\Blogger\Repositories;

use Cswiley\Blogger\Models\Blog;

class BlogRepository
{
    protected $query;
    protected $blog;

    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    public function active()
    {
        $this->query = $this->blog::onlyActive();
        return $this;
    }

    public function idOrSlug($value)
    {
        $this->query =  $this->blog::idOrSlug($value);
        return $this;
    }

    public function execute()
    {
        return $this->query;
    }

}