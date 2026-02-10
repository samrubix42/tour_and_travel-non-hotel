<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Destination extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'banner_image',
        'status',
        'storage_path',
        'banner_storage_path',
        'imagekit_file_id',
        'banner_imagekit_file_id',
        'is_featured',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Categories attached to this destination.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'destination_categories');
    }
}
