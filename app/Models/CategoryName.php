<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $category_id
 * @property string $language
 * @property string $name
 * @property Category $category
 */
class CategoryName extends Model
{
    protected $fillable = [
        'id',
        'category_id',
        'language',
        'name',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}