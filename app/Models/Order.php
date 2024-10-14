<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Define the table name if it is different from the default (plural of the model name)
    protected $table = 'orders';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'orderID';

    // Specify which attributes can be mass assigned
    protected $fillable = [
        'customerID',
        'orderDate',
        'status',
        'totalPrice',
        'shippingAddress',
    ];

    // Define the relationship with the Customer model (assuming you have a Customer model)
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerID', 'customerID');
    }
}
