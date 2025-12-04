<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'button_text',
        'button_url',
        'status',
        'image_url',
        'storage_path',
        'imagekit_file_id',
    ];
}
