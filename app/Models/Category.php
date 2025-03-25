<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Kalnoy\Nestedset\NodeTrait;

/**
 * @property int $id
 * @property int _lft
 * @property int _rgt
 * @property int parent_id
 * @property Collection $names
 */
class Category extends Model
{
    use NodeTrait;

    protected $fillable = [
        '_lft',
        '_rgt',
        'parent_id',
    ];

    public function names(): HasMany
    {
        return $this->hasMany(CategoryName::class, 'category_id', 'id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class,'category_id', 'id');
    }

    public function englishName(): Attribute
    {
        return Attribute::make(get: function () {
            $categoryName = $this->names()
                                 ->where(['language' => 'en'])
                                 ->first();

            return $categoryName->name;
        });
    }
}