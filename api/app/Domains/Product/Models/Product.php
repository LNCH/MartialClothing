<?php

namespace App\Domains\Product\Models;

use App\Concerns\Filterable;
use App\Concerns\HasPrice;
use App\Domains\Category\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasPrice, Filterable;

    protected $fillable = [
        'name',
        'ident',
        'price',
        'description',
    ];

    public function getRouteKeyName()
    {
        return 'ident';
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_products');
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class)->orderBy('order', 'asc');
    }
}
