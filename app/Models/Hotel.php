<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
     protected $fillable = [
        'category_id',
        'destination_id',
        'name',
        'slug',
        'address',
        'rating',
        'description',
        'image_url',
        'storage_path',
        'imagekit_file_id',
        'phone',
        'email',
        'amenities',
        'facilities',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'long_description',
        'location',
        'map_embed',
        'status',
    ];

    protected $casts = [
        'amenities' => 'array',
        'facilities' => 'array',
        'status' => 'boolean',
    ];


    public function category()
    {
        return $this->belongsTo(HotelCategory::class, 'category_id');
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }

    public function galleries()
    {
        return $this->hasMany(HotelGallery::class, 'hotel_id');
    }
}
