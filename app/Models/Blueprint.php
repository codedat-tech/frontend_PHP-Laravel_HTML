<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blueprint extends Model
{
    // Specify the table name if it's not the plural of the model name
    protected $table = 'blueprints';

    // Specify the primary key column
    protected $primaryKey = 'blueprintID';

    protected $fillable = ['name', 'description', 'categoryDesignID', 'image'];

    // Define the relationship with CategoryDesign
    public function categoryDesign()
    {
        return $this->belongsTo(CategoryDesign::class, 'categoryDesignID', 'categoryDesignID');
    }

}
