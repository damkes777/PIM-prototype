<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property int parameter_id
 */
class ParameterValue extends Model
{
    protected $fillable = [
        'id',
        'parameter_id',
    ];

    public function parameter(): BelongsTo
    {
        return $this->belongsTo(Parameter::class, 'parameter_id', 'id');
    }

    public function names(): HasMany
    {
        return $this->hasMany(ParameterValueName::class, 'parameter_value_id', 'id');
    }
}