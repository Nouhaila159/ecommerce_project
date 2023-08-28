<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class FrontendUser extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    protected $table = 'frontend_users';

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $fillable = [
        'firstname', 'lastname', 'email', 'phone', 'gender', 'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

