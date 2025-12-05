<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactForTour extends Model
{
    protected $fillable = [
        'name',
        'tour_id',
        'destination_id',
        'email',
        'phone',
        'message',
        'check_in_date',
        'check_out_date',
        'no_of_adults',
        'children',
        'consent',
        'status',
        'ip',
    ];
}
