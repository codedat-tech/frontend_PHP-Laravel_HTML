<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageProducts extends Model
{
    use HasFactory;

    protected $primaryKey = 'imageProductID';

    protected $fillable = [
        'productID',
        'name',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'productID', 'productID');
    }
}
