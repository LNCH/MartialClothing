<?php

namespace App\Domains\Category\Models;

use App\Concerns\HasChildren;
use App\Concerns\Orderable;
use App\Domains\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasChildren, Orderable;

    protected $fillable = [
        'name', 'ident', 'order'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_products');
    }
}
