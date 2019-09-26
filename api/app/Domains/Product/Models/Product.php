<?php

namespace App\Domains\Product\Models;

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
}
