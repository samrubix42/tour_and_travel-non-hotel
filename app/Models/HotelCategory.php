<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelCategory extends Model
{
     protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
    ];

    public function hotels()
    {
        return $this->hasMany(Hotel::class, 'category_id');
    }
}
