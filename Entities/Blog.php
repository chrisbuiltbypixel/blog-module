<?php

namespace Modules\Blog\Entities;

use Modules\Core\Traits\FilteredSearch;
use Modules\Blog\Database\factories\BlogFactory;
use Laravel\Scout\Searchable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory, Searchable, FilteredSearch;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'published',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'published' => 'bool',
    ];

    protected static function newFactory()
    {
        return BlogFactory::new ();
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->only('id', 'title');
    }
}
