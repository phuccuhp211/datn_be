<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCatalog extends Model
{
    use HasFactory;

    protected $table = 'Product_catalogs';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];
    
    public function products()
    {
        return $this->hasMany(Product::class, 'type', 'id');
    }
}