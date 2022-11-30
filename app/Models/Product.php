<?php

namespace App\Models;

use App\Traits\HasScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, HasScope;

    protected $fillable = [
        'name', 'category_id', 'image', 'barcode', 'description', 'buy_price', 'sell_price', 'stock'
    ];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($image) => asset('storage/products/' . $image),
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
