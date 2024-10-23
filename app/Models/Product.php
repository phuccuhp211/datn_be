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

    public function images()
    {
        return $this->hasMany(Image::class, 'reference_id')->where('table', 'products');
    }
    public function prices()
    {
        return $this->hasMany(ProductPrice::class, 'product_id');
    }

    public function catalog()
    {
        return $this->belongsTo(ProductCatalog::class, 'type', 'id');
    }
}