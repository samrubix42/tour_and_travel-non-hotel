<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackageSliderImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_package_id',
        'image_url',
        'storage_path',
        'imagekit_file_id',
        'sort_order',
    ];

    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }
}
