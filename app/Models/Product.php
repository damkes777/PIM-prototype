<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $sku
 * @property string $ean
 * @property int $quantity
 * @property string $brand
 * @property int $file_id
 */
class Product extends Model
{
    protected $fillable = [
        'sku',
        'ean',
        'quantity',
        'brand',
        'file_id',
    ];

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
}
