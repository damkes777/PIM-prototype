<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $name
 * @property int $brand_id
 * @property string $sku
 * @property string $ean
 * @property int $price
 * @property int $quantity
 */
class Product extends Model
{
    protected $fillable = [
        'name',
        'brand_id',
        'sku',
        'ean',
        'price',
        'quantity',
    ];

    public function brand(): HasOne
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }
}
