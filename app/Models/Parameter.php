<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 */
class Parameter extends Model
{
    protected $fillable = [
        'id',
    ];

    public function names(): HasMany
    {
        return $this->hasMany(ParameterName::class, 'parameter_id', 'id');
    }

    public function values(): HasMany
    {
        return $this->hasMany(ParameterValue::class, 'parameter_id', 'id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'products_parameters', 'product_id', 'parameter_id');
    }

    public function englishName(): Attribute
    {
        return Attribute::make(get: function () {
            $parameterName = $this->names()
                                  ->firstWhere(['language' => 'en']);

            return $parameterName->name;
        });
    }
}