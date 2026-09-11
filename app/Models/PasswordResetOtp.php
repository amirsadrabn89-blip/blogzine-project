<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetOtp extends Model
{
    protected $fillable = [
        'phone_number',
        'otp',
        'expires_at',
        'phone_number',
        'otp',
        'expire_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    protected $table = 'password_reset_otps';

}
