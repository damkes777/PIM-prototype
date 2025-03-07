<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 */
class Brand extends Model
{
    protected $fillable = [
        'name',
    ];

    public function products(): BelongsToMany
    {
        $this->belongsTo(Product::class, 'brand_id', 'id');
    }
}