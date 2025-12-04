<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TourPackage;

class Experience extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'status',
        'image',
        'storage_path',
        'imagekit_file_id',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function tourPackages()
    {
        return $this->belongsToMany(TourPackage::class, 'tour_package_experiences');
    }
}
