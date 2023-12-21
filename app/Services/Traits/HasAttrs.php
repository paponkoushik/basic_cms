<?php

namespace App\Services\Traits;

use Illuminate\Support\Arr;

trait HasAttrs
{
    protected array $attributes = [];

    public function setAttrs(array $attrs): self
    {
        $this->attributes = $attrs;

        return $this;
    }

    public function getAttrs($columns = null): array
    {
        $columns = is_array($columns) ? $columns : func_get_args();

        if (count($columns)) {
            return Arr::only($this->attributes, $columns);
        }

        return $this->attributes;
    }
    public function getAttribute($key, $default = null)
    {
        return isset($this->attributes[$key]) ? $this->attributes[$key] : $default;
    }

    public function setAttribute($key, $value): self
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    public function mergeAttrs(array $attrs): self
    {
        $this->attributes = array_merge($this->attributes, $attrs);

        return $this;
    }
}
