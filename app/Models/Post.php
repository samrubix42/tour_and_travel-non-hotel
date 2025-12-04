<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'category_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'featured_image',
        'thumbnail_image',
        'featured_storage_path',
        'thumbnail_storage_path',
        'featured_image_kit_file_id',
        'thumbnail_image_kit_file_id',
        'title',
        'slug',
        'main_content',
        'tags',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }
}
