<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'popular',
        'slug',
        'image',
        'meta_keyword',
        'meta_title',
        'meta_description',
        'description',
    ];
}