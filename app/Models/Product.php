<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'catalog_number',
        'title',
        'image',
        'description',
        'affiliate_link',
        'category_id',
        'click_count'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
