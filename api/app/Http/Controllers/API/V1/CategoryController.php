<?php

namespace App\Http\Controllers\API\V1;

use App\Domains\Category\Models\Category;
use App\Domains\Category\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(
            Category::with('children')->parents()->ordered()->get()
        );
    }
}
