<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelGallery extends Model
{
    protected $fillable = [
        'hotel_id',
        'image_url',
        'storage_path',
        'imagekit_file_id',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
}
