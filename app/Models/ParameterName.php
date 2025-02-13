<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int parameter_id
 * @property string $language
 * @property string $name
 */
class ParameterName extends Model
{
    protected $fillable = [
        'id',
        'parameter_id',
        'language',
        'name',
    ];

    public function parameter(): BelongsTo
    {
        return $this->belongsTo(Parameter::class, 'parameter_id', 'id');
    }
}