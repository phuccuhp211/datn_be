<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryCatalog extends Model
{
    use HasFactory;

    protected $table = 'Story_catalogs';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'index'];

    public function catalog() {
        return $this->hasMany(Story::class, 'catalog_id', 'id');
    }
}