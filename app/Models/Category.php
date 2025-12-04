<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
        protected $fillable = [
        'name',
        'description',
        'slug',
        'status',
        'category_image',  
        'storage_path',        
        'imagekit_file_id',    
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Destinations attached to this category.
     */
    public function destinations()
    {
        return $this->belongsToMany(Destination::class, 'destination_categories');
    }
}
