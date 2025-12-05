<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function featuredMedia()
    {
        return $this->belongsTo(MediaAsset::class, 'featured_media_id');
    }
}
