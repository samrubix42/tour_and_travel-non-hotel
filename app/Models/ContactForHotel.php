<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactForHotel extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'no_of_persons',
        'check_in',
        'check_out',
        'email',
        'phone',
        'message',
        'ip',
    ];
}
