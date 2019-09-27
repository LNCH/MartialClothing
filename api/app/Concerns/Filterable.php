<?php

namespace App\Concerns;

use App\Filters\Filterer;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    public function scopeFilters(Builder $builder, array $scopes = [])
    {
        return (new Filterer(request()))->apply($builder, $scopes);
    }
}
