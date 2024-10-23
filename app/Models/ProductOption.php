<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    use HasFactory;

    protected $table = 'Product_options';
    protected $primaryKey = 'id';
    protected $fillable = ['price_id', 'name', 'quantity'];

    public function price()
    {
        return $this->belongsTo(ProductPrice::class, 'price_id');
    }
}
