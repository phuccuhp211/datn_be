<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    protected $table = 'Sponsors';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'amount', 'date'];
}