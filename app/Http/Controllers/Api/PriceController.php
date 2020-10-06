<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index()
    {
        $prices = [
        'Less than 50',
        'From 50 to 100',
        'From 100 to 500',
        'More than 500',
    ];
       $pricess = [];

        foreach($prices as $index => $name) {
            $pricess[] = [
                'name' => $name,
            ];
        }

        return $pricess;
    }
}
