<?php

namespace App\Services;

use Illuminate\Support\Collection;

class CategoryNamesService
{
    public function __construct(
        protected CategoryService $categoryService
    ) {
    }

    public function getNames(int $categoryId): Collection
    {
        $category = $this->categoryService->findCategory($categoryId);

        return $category->names;
    }
}