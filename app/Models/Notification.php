<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'Notification';

    protected $fillable = [
        'consultationID',
        'message',
        'is_read',
    ];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'consultationID');
    }
}
