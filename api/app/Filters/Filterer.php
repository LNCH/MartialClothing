<?php

namespace App\Filters;

use App\Filters\Contracts\FilterContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Filterer
{
    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder, array $filters)
    {
        foreach ($filters as $key => $filter) {
            if (!$filter instanceof FilterContract || !$this->request->has($key)) {
                continue;
            }

            $filter->apply($builder, $this->request->get($key));
        }

        return $builder;
    }
}
