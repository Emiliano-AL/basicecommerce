<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'sku',
        'price',
        'stock',
        'image',
        'manufacturer',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
