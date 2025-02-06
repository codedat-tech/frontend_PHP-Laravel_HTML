<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryDesign extends Model
{
    // Specify the table name if it's not the plural of the model name
    protected $table = 'category_designs';

    // Specify the primary key column
    protected $primaryKey = 'categoryDesignID';



    // Optionally specify the fields that are mass assignable
    protected $fillable = ['name', 'status'];

    public function blueprints()
    {
        return $this->hasMany(Blueprint::class, 'categoryDesignID');
    }
}
