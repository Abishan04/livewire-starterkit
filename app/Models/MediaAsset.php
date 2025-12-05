<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaAsset extends Model
{
    protected $fillable = [
        "path",
        "alt",
        "title",
        "description",
        "type",
        "name"
    ];
    public function posts()
    {
        return $this->hasMany(Post::class, 'featured_media_id');
    }

    public function pages()
    {
        return $this->hasMany(Page::class, 'featured_media_id');
    }
}
