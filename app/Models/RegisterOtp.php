<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisterOtp extends Model
{
    protected $table = 'register_otp';

    protected $fillable = [
        'phone_number',
        'otp',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
}