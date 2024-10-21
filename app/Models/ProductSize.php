<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'size',
        'price',
        'discount_price'
    ];

    public function options()
    {
        return $this->hasMany(ProductOption::class, 'size_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
