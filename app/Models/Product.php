<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_id',
        'small_desc',
        'description',
        'orginal_price',
        'selling_price',
        'image',
        'qty',
        'tax',
        'slug',
        'status',
        'trending',
        'meta_title',
        'meta_description',
        'meta_keyword'

    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
