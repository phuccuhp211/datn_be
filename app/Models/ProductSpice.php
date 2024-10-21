<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSpice extends Model
{
    use HasFactory;
    protected $table = 'Product_spices';
    protected $primaryKey = 'id';
    protected $fillable = ['product_id', 'name'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}