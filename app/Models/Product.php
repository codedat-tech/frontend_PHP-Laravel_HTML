<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Set the primary key
    protected $primaryKey = 'productID';
    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'productID',
        'categoryID',
        'brandID',
        'name',
        'price',
        'description',
        'image',
        'quantity', 
    ];

    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryID', 'categoryID');
    }

    // Relationship with Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brandID', 'brandID');
    }
}
