<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Experience;

class TourPackage extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'title',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'slug',
        'featured_image',
        'storage_path',
        'imagekit_file_id',
        'is_featured',
        'includes',
        'optional',
        'itinerary',
        'description',
        'status',
        'price',
    ];


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'tour_package_categories');
    }

    public function destinations()
    {
        return $this->belongsToMany(Destination::class, 'tour_package_destinations');
    }

    public function galleries()
    {
        return $this->hasMany(TourPackageGallery::class);
    }

    public function experiences()
    {
        return $this->belongsToMany(Experience::class, 'tour_package_experiences');
    }
}
