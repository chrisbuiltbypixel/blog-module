<?php

namespace Modules\Blog\Entities;

use Modules\Blog\Database\factories\BlogFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
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
}
