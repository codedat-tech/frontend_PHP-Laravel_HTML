<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewConsultation extends Model
{
    use HasFactory;

    protected $table = 'review_consultations';

    protected $primaryKey = 'reviewConsultationID'; // Set the primary key

    public $incrementing = false; // If your primary key is not auto-incrementing

    protected $keyType = 'string'; // Set the key type if it's a string

    protected $fillable = [
        'reviewConsultationID', // Add this to fillable
        'consultationID',
        'rating',
        'comment',
        'createdAT',
    ];

    // Optionally, you can set timestamps if you're managing createdAt and updatedAt fields
    public $timestamps = true; // This is true by default
}
