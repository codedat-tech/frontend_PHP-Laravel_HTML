<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category; // Add this line to import the Category model


class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];
}