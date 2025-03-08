<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $name
 * @property string $sku
 * @property string $ean
 * @property int $price
 * @property int $quantity
 * @property int $brand_id
 * @property int $file_id
 */
class Product extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'ean',
        'price',
        'quantity',
        'brand_id',
        'file_id',
    ];

    public function brand(): HasOne
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function file(): HasOne
    {
        return $this->hasOne(ProductFile::class, 'product_id', 'id');
    }
}
