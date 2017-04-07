<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    protected $fillable = ['title', 'slug'];

    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }

    public static function setSlug($value)
    {
        $slug = Str::slug($value);

        $count = self::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }
}