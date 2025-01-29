<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    public function __construct()
    {
    }

    public function create(array $names): Category
    {
        return DB::transaction(function () use ($names) {
            $category = Category::create();
            $category->names()
                     ->createMany($names);

            return $category;
        });
    }
}
