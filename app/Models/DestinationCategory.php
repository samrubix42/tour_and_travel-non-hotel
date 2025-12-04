<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DestinationCategory extends Model
{
    protected $fillable=[
        'destination_id',
        'category_id',
    ];
}
