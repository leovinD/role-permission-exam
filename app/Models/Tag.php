<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'tag_name',
        'tag_slug',
        'tag_desc'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
