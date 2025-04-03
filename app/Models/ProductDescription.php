<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int product_id
 * @property string language
 * @property string $description
 */
class ProductDescription extends Model
{
    protected $table = 'product_descriptions';

    protected $fillable = ['product_id', 'language', 'description'];
}