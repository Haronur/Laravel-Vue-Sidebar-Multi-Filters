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
            });
    }
}
