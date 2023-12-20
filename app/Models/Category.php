<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }
}
