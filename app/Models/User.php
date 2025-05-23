<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Activity;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'full_name',
        'username',
        'email',
        'password',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function victims()
    {
        return $this->hasMany(Victim::class);
    }

    public function getActivePlanAttribute()
    {
        return $this->subscription ? $this->subscription->plan : null;
    }

    // app/Models/User.php
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function recentActivities($limit = 5)
    {
        return $this->activities()->latest()->limit($limit)->get();
    }
}
