<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

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
                'products_count' => $this->getProductCount($index)
            ];
        }

        return $pricess;
    }
    private function getProductCount($index)
    {
        return Product::withFilters()
            ->when($index == 0, function ($query) {
                $query->where('price', '<', '5000');
            })
            ->when($index == 1, function ($query) {
                $query->whereBetween('price', ['5000', '10000']);
            })
            ->when($index == 2, function ($query) {
                $query->whereBetween('price', ['10000', '50000']);
            })
            ->when($index == 3, function ($query) {
                $query->where('price', '>', '50000');
            })
            ->count();
    }
}
