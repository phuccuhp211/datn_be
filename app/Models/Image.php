<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'Images';
    protected $primaryKey = 'id';
    protected $fillable = ['table', 'id_reference', 'url'];
    public $timestamps = false;

}