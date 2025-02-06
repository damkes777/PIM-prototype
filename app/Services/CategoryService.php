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

    public function createChild(Category $parent, array $names): Category
    {
        return DB::transaction(function () use ($parent, $names) {
            $category = Category::create(['parent_id' => $parent->id]);
            $category->names()
                     ->createMany($names);

            return $category;
        });
    }

    public function delete(int $id): void
    {
        $category = $this->findCategory($id);
        $category->delete();
    }

    public function findCategory(int $id): Category
    {
        return Category::query()
                       ->findOrFail($id);
    }

    public function getParent(int $id): Category|null
    {
        $category = $this->findCategory($id);
        $parentId = $category->getParentId();

        if ($parentId) {
            return $this->findCategory($parentId);
        }

        return null;
    }
}
