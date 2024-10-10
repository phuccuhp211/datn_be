<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalCatalog extends Model
{
    use HasFactory;

    public function animals()
    {
        return $this->hasMany(Animal::class, 'type', 'id');
    }
}
