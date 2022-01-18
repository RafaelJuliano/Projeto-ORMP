<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Models\products\Category;
use \App\Models\products\Product;

class CreateProductsNnCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_nn_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class);
            $table->foreignIdFor(Category::class);                                
            $table->timestamps();
        }); 
        
        Schema::table('products_nn_categories', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_nn_categories');
    }
}
