<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Extends User class for authentication
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;


class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'customerID';

    protected $fillable = [
        'fullname', 'email', 'password', 'phone', 'address',
    ];

    protected $hidden = [
        'password',
    ];

    public $timestamps = true;
}
