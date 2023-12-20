<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = ['slug', 'title', 'content', 'author', 'published_at'];

    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
