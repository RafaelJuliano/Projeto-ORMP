<?php

namespace App\Models\products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\products\Product;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
