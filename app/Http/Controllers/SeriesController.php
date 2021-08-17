<?php

namespace App\Http\Controllers;

use App\Models\Series;

class SeriesController extends BaseController
{

    public function __construct()
    {
        $this->classe = Series::class;
    }
}
