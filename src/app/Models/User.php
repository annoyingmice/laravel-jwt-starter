<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Traits\Base;
use App\Models\Traits\UserTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Base, 
        HasFactory, 
        Notifiable, 
        UserTrait, 
        SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        // @TODO
        // @FRONTEND
        // Format: (+00)-000-000-0000 / 000-0000
        'phone',
        // @TODO
        // @FRONTEND
        // country, region, state/province, city/municipality, Str. Name, House No./ Building No.
        'address',
        'password',
        'otp_secret'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'otp_secret',
        'remember_token',
        'pivot'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
