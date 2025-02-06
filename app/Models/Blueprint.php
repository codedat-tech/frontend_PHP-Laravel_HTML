<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blueprint extends Model
{
    protected $table = 'blueprints';
    protected $primaryKey = 'blueprintID';
    protected $fillable = [
        'name',
        'designerID',
        'categoryDesignID',
        'image',
        'status',
    ];
    public function categoryDesign()
    {
        return $this->belongsTo(CategoryDesign::class, 'categoryDesignID', 'categoryDesignID');
    }
    public function designer()
    {
        return $this->belongsTo(Designer::class, 'designerID', 'designerID');
    }
}
