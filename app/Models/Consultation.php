<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $table = 'consultations';

    protected $primaryKey = 'consultationID';
    public $incrementing = true;
    protected $fillable = [
        'designerID',
        'customerID',
        'scheduledAT',
        'status1',
        'status',
        'note',
        'lastNotifiedAt',
        'alert_sent'
    ];

    // n-1: Mối quan hệ với Customers
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerID');
    }

    // n-1: Mối quan hệ với Designers
    public function designer()
    {
        return $this->belongsTo(Designer::class, 'designerID');
    }
}
