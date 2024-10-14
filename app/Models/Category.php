<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Specify the primary key column name
    protected $primaryKey = 'categoryID';

    // Indicate if the primary key is an incrementing integer
    public $incrementing = true;

    // Specify the data type of the primary key
    protected $keyType = 'int';

    // Specify the fields that can be mass-assigned, including 'image'
    protected $fillable = ['name', 'description', 'image'];
    public function products() {
        return $this->hasMany(Product::class, 'categoryID');

}
}

