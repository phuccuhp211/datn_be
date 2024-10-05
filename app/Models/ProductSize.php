<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $fillable = ['size'];

    public function spices()
    {
        return $this->belongsToMany(ProductSpice::class, 'product_size_spice')->withPivot('price', 'quantity');
    }
}