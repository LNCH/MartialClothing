<?php

namespace App\Filters;

use App\Filters\Contracts\FilterContract;
use Illuminate\Database\Eloquent\Builder;

class CategoryFilter implements FilterContract
{
    public function apply(Builder $builder, $value)
    {
        if (!method_exists($builder->getModel(), 'categories')) {
            return $builder;
        }

        return $builder->whereHas('categories', function ($query) use ($value) {
            $query->where('ident', $value);
        });
    }
}
