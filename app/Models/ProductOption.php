<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'size_id',
        'flavor',
        'color',
        'quantity'
    ];

    public function size()
    {
        return $this->belongsTo(ProductSize::class, 'size_id');
    }
}
