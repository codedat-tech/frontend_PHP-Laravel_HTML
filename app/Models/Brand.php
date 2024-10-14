<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    // Set the primary key
    protected $primaryKey = 'brandID';
    public $incrementing = false;

    protected $keyType = 'string';


    protected $fillable = [
        'brandID',
        'name',
        'description',
        'image',
    ];

    // Relationship with Product
    public function products()
    {
        return $this->hasMany(Product::class, 'brandID', 'brandID');
    }
}
