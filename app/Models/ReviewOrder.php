<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewOrder extends Model
{
    use HasFactory;

    protected $primaryKey = 'reviewOrderID'; // Specify the primary key
    protected $fillable = ['orderID', 'rating', 'comment', 'createAT'];

    // Define the relationship if needed
    public function order()
    {
        return $this->belongsTo(Order::class, 'orderID', 'orderID');
    }
}
