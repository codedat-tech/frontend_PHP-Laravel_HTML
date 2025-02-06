<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'productID';

    protected $fillable = [
        'categoryID',
        'brandID',
        'name',
        'price',
        'quantityInStock',
        'inStocked',
        'status',
        'description',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryID');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brandID');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'productID', 'productID');
    }
    // Define the inverse relationship with Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'orderID'); // Adjust 'order_id' to your actual foreign key
    }
}
