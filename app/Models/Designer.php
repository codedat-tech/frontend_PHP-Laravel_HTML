<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Use this instead of Model
use Illuminate\Notifications\Notifiable;

class Designer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'designers'; // Specify the table name
    protected $primaryKey = 'designerID'; // Set the primary key

    public $incrementing = false; // Primary key is not auto-incrementing
    protected $keyType = 'string'; // Primary key is a string

    protected $fillable = [
        'fullname', 'email', 'password', 'phone', 'address',
        'portfolio', 'experienceYear', 'specialization', 'rating','image',
    ];

    protected $hidden = [
        'password', 'remember_token', // Hide password and token fields
    ];
}
