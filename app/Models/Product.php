<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'img', 'type', 'purpose', 'description', 'slug'];

    public function sizes()
    {
        return $this->belongsToMany(ProductSize::class, 'product_size_spice')->withPivot('price', 'quantity');
    }
}