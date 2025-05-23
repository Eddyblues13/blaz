<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Victim extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'wallet_address',
        'balance',
        'currency',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
