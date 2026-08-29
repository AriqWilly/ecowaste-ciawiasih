<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'category_id', 'name', 'slug', 'description', 'price', 
    'stock', 'image_path', 'seller_name', 'seller_phone', 'is_published'
])]
class Product extends Model
{
    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
