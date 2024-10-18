<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $table = 'Stories';
    protected $primaryKey = 'id';
    protected $fillable = ['thumbnail', 'catalog_id', 'title', 'content', 'author_id', 'date'];


    public function catalog()
    {
        return $this->belongsTo(StoryCatalog::class, 'catalog_id', 'id');
    }
}