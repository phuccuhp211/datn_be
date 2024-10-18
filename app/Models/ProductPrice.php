<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    use HasFactory;

    protected $table = 'Product_prices';
    protected $primaryKey = 'id';
    protected $fillable = ['product_id', 'name', 'price', 'sale', 'sale_from', 'sale_to'];


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}