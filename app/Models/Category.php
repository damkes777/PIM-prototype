<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kalnoy\Nestedset\NodeTrait;

/**
 * @property int $id
 * @property int _lft
 * @property int _rgt
 * @property int parent_id
 * @property CategoryName[] $names
 */
class Category extends Model
{
    use NodeTrait;

    protected $fillable = [
        '_lft',
        '_rgt',
        'parent_id'
    ];

    public function names(): HasMany
    {
        return $this->hasMany(CategoryName::class, 'category_id', 'id');
    }
}