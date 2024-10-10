<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $table = 'Animals';
    protected $primaryKey = 'id';
    protected $fillable = ['type', 'img', 'name', 'age', 'gender', 'colors', 'genitive', 'health_info', 'fomr_request_id'];

    public function catalog() 
    {
        return $this->belongsTo(AnimalCatalog::class, 'type', 'id');    
    }



}
