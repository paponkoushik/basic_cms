<?php

namespace App\Services;

use App\Services\Traits\HasAttrs;
use Illuminate\Database\Eloquent\Model;

class BaseService
{
    use HasAttrs;
    protected $model;

    public function setModel(Model $model): BaseService
    {
        $this->model = $model;
        return $this;
    }

    public function getModel(): Model
    {
        return $this->model;
    }
}
