<?php

namespace App\Http\Controllers;

use App\Models\Blueprint;

class GalleryController extends Controller
{
    public function index()
    {
        // Fetch all blueprints from the database
        $blueprints = Blueprint::all();

        // Return the view with the blueprints data
        return view('interior-design', compact('blueprints'));
    }
}
