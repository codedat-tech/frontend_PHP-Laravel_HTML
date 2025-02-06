<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Use this instead of Model
use Illuminate\Notifications\Notifiable;

class Designer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'designers';
    protected $primaryKey = 'designerID';

    public $incrementing = true;
    protected $keyType = 'string';

    protected $fillable = [
        'fullname',
        'email',
        'password',
        'phone',
        'address',
        'portfolio',
        'experienceYear',
        'specialization',
        'rating',
        'image',
        'remember_token',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function blueprints()
    {
        return $this->hasMany(Blueprint::class, 'designerID', 'designerID');
    }
    public function consultations()
    {
        return $this->hasMany(Consultation::class, 'designerID');
    }
}
