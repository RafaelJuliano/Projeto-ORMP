<?php

namespace App\Models\products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\products\Brand;
use App\Models\products\Category;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'name',
        'description',
        'price',
        'quantity',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'products_nn_categories');
    }
}
