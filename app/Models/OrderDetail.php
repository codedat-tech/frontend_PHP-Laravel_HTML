<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $primaryKey = 'orderDetailID';

    protected $fillable = [
        'productID',
        'orderID',
        'quantity',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'productID', 'productID');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'orderID', 'orderID');
    }
}
