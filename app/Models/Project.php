<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'total_amount',
        'raised_amount',
        'project_image_url',
        'status',
    ];

    public function sponsors()
    {
        return $this->hasMany(Sponsor::class);
    }
}