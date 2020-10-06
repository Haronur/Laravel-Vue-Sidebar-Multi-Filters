<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
   public function index()
    {
    	// return Category::all();
        return $categories = Category::withCount(['products' => function ($query) {
                $query->withFilters();
            }])
            ->get();
    }
}
