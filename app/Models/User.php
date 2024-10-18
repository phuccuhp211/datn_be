<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'Users';
    protected $primaryKey = 'id';
    protected $fillable = ['account', 'password', 'name', 'phone', 'email', 'address', 'role', 'rescue_cases', 'adopted', 'cart', 'lock'];
    protected $hidden = ['password', 'remember_token'];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}