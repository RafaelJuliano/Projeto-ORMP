<?php

namespace App\Models\products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\products\Product;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_nn_categories');
    }

    
}
