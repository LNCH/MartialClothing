<?php

namespace App\Domains\Product\Models;

use App\Domains\Category\Models\Category;
use App\Domains\Product\Models\ProductVariation;
use App\Filters\Filterer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
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

    public function scopeFilters(Builder $builder, array $scopes = [])
    {
        return (new Filterer(request()))->apply($builder, $scopes);
    }
}
