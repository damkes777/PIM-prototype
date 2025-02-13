<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int parameter_value_id
 * @property string language
 * @property string name
 */
class ParameterValueName extends Model
{
    protected $fillable = [
        'id',
        'parameter_value_id',
        'language',
        'name',
    ];

    public function parameterValue(): BelongsTo
    {
        return $this->belongsTo(ParameterValue::class, 'parameter_value_id', 'id');
    }
}