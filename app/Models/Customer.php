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
    public $incrementing = true;
    protected $hidden = [
        'password',
    ];
    public $timestamps = true;
    protected $table = 'customers';
    protected $fillable = [
        'fullname',
        'email',
        'password',
        'phone',
        'address',
        'remember_token',
        'status',
    ];

    public function consultations()
    {
        return $this->hasMany(Consultation::class, 'customerID');
    }
}
