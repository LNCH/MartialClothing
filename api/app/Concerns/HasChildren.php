<?php

namespace App\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait HasChildren
{
    public function scopeParentsOnly(Builder $builder): void
    {
        $builder->whereNull('parent_id');
    }

    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
}
