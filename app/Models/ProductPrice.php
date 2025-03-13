<?php

namespace App\Models;

use App\Facades\PriceHelper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $product_id
 * @property int $price
 * @property string $currency
 */
class ProductPrice extends Model
{
    protected $fillable = [
        'product_id',
        'price',
        'currency',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function price(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return PriceHelper::castToString($value);
            },
            set: function ($value) {
                return PriceHelper::castToInt($value);
            }
        );
    }
}