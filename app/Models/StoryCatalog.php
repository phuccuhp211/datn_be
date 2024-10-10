<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryCatalog extends Model
{
    use HasFactory;

    public function catalog() {
        return $this->hasMany(Story::class, 'catalog_id', 'id');
    }
}
