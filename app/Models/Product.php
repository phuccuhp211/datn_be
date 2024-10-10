<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'Products';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'type', 'purpose', 'out_of_stock'];

    public function prices()
    {
        return $this->hasMany(ProductPrice::class, 'product_id', 'id')->select(['id', 'name', 'price', 'sale']);
    }

    public function spices()
    {
        return $this->hasMany(ProductSpice::class, 'product_id', 'id');
    }

    public function catalog()
    {
        return $this->belongsTo(ProductCatalog::class, 'type', 'id');
    }
}