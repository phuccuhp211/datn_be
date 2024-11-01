<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'Invoices';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'list', 'amount', 'discount', 'status', 'coupon', 'total'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}