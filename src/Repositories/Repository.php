<?php

namespace Cswiley\Blogger\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository
{
    protected $query;
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->query = $model;
    }

    public function execute()
    {
        $query       = $this->query;
        $this->query = $this->model;

        return $query;
    }

}