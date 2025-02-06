<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $primaryKey = 'orderID';

    protected $fillable = [
        'customerID',
        'orderDate',
        'status1',
        'status',
        'totalPrice',
        'shippingAddress',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerID', 'customerID');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'orderID', 'orderID');
    }
    public function reviewOrder()
    {
        return $this->hasMany(ReviewOrder::class, 'orderID', 'orderID');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'order_id', 'orderID'); // Adjust 'order_id' to your actual foreign key
    }
}
