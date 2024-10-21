<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'images'
    ];

    public function images()
    {
        return $this->hasMany(Image::class, 'reference_id')->where('table', 'products');
    }
    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }
}
