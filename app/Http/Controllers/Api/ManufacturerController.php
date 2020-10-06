<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manufacturer;

class ManufacturerController extends Controller
{
   public function index()
    {
        // return Manufacturer::all();
          return $manufacturers = Manufacturer::withCount(['products' => function ($query) {
                $query->withFilters();
            }])
            ->get();
    }
}
