<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
    'page_title',
    'slug',
    'page_content',
    'meta_title',
    'meta_description',
    'meta_keywords',
    ];
}
