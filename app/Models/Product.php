<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $sku
 * @property string $ean
 * @property int $quantity
 * @property string $brand
 * @property int $category_id
 * @property int $file_id
 */
class Product extends Model
{
    protected $fillable = [
        'sku',
        'ean',
        'quantity',
        'brand',
        'category_id',
        'file_id',
    ];

    public function englishName(): Attribute
    {
        return Attribute::make(get: function () {
            $productName = $this->names()
                                ->where(['language' => 'en'])
                                ->first();

            return $productName->name;
        });
    }

    public function file(): HasOne
    {
        return $this->hasOne(ProductFile::class, 'product_id', 'id');
    }

    public function names(): HasMany
    {
        return $this->hasMany(ProductName::class, 'product_id', 'id');
    }

    public function prices(): HasMany
    {
        return $this->hasMany(ProductPrice::class, 'product_id', 'id');
    }

    public function parameters(): BelongsToMany
    {
        return $this->belongsToMany(Parameter::class, 'products_parameters', 'parameter_id', 'product_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
