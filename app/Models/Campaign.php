<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject',
        'message',
        'recipients_count',
        'status',
        'is_bulk'
    ];

    protected $casts = [
        'is_bulk' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
