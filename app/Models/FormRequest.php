<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormRequest extends Model
{
    use HasFactory;

    protected $table = 'Form_requests';
    protected $primaryKey = 'id';
    protected $fillable = ['type', 'created_at', 'status', 'name', 'phone', 'email', 'address', 'message', 'addition_infomation'];

}