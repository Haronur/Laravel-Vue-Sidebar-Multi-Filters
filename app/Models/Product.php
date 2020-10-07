<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'manufacturer_id', 'name', 'description', 'price'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function scopeWithFilters($query)
    {
        return $query->when(count(request()->input('manufacturers', [])), function ($query) {
                $query->whereIn('manufacturer_id', request()->input('manufacturers'));
            })
            ->when(count(request()->input('categories', [])), function ($query) {
                $query->whereIn('category_id', request()->input('categories'));
            })
            ->when(count(request()->input('prices', [])), function ($query) {
                $query->where(function ($query) {
                    $query->when(in_array(0, request()->input('prices')), function ($query) {
                            $query->orWhere('price', '<', '5000');
                        })
                        ->when(in_array(1, request()->input('prices')), function ($query) {
                            $query->orWhereBetween('price', ['5000', '10000']);
                        })
                        ->when(in_array(2, request()->input('prices')), function ($query) {
                            $query->orWhereBetween('price', ['10000', '50000']);
                        })
                        ->when(in_array(3, request()->input('prices')), function ($query) {
                            $query->orWhere('price', '>', '50000');
                        });
                });
            });
    }
}
