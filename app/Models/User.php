<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use SoftDeletes;
    protected $table = 'user';
    protected $fillable = ['name','email','password','activation_key','is_active'];


    protected $hidden = ['password','remember_token','activation_key'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
