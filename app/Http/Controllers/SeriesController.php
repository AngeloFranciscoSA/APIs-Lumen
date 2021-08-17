<?php

namespace App\Http\Controllers;

use App\Models\Series;

class SeriesController{

    public function index()
    {
        return Series::all();
    }
}
