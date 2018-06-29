<?php

namespace Cswiley\Blogger\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use ParentIterator;
use function preg_replace;
use function rtrim;

class Blog extends Model
{
    const VISIBILITY_PRIVATE = 1;
    const VISIBILITY_PUBLIC  = 2;

    protected $dates = [
        'created_at',
        'updated_at',
        'published_at',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'visibility_eng',
        'is_public',
        'is_active',
        'image_url',
    ];

    static public $visibilityLookup = [
        self::VISIBILITY_PRIVATE => 'private',
        self::VISIBILITY_PUBLIC  => 'public',
    ];

    public function getVisibilityEngAttribute()
    {
        return $this->attributes['visibility_eng'] = self::$visibilityLookup[$this->visibility] ?? 'private';
    }

    public function getIsPublicAttribute()
    {
        return $this->attributes['is_public'] = $this->visibility === self::VISIBILITY_PUBLIC;
    }

    public function getIsActiveAttribute()
    {
        return $this->attributes['is_active'] = ($this->published_at < Carbon::now()) && $this->is_public;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function setSlugAttribute($value)
    {
        $slug = preg_replace('/[\ \$\-\_\.\+\!\*\'\?)(}{]/', '-', trim($value));
        $slug = rtrim(ltrim($slug, '-'), '-');
        $this->attributes['slug'] = strtolower($slug);
    }

    static public function activeBlogs()
    {
        return self::whereDate('published_at', '<', Carbon::now())->where('visibility', self::VISIBILITY_PUBLIC);
    }

    public function getImageUrlAttribute()
    {
        $imageUrl = '';

        if ($this->image) {
            if (Storage::disk(config('blogger.storage_disk'))->exists($this->image)) {
                $imageUrl = Storage::disk(config('blogger.storage_disk'))->url($this->image);
            }
        }

        return $this->attributes['image_url'] = $imageUrl;
    }

}
