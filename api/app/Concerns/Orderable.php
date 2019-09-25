<?php

namespace App\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait Orderable
{
    public function scopeOrdered(Builder $builder, $direction = 'asc'): void
    {
        $builder->orderBy('order', $direction);
    }
}
