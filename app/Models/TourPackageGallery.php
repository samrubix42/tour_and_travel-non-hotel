<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourPackageGallery extends Model
{
    protected $fillable = [
        'tour_package_id',
        'image_url',
        'storage_path',
        'imagekit_file_id',
    ];

    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }
}
