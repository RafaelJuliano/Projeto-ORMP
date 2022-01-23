<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Models\products\Brand;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->nullable();
            $table->string('name');            
            $table->text('description')->nullable();            
            $table->double('price', 10, 2);
            $table->integer('quantity');
            $table->foreignIdFor(Brand::class)->nullable();                                  
            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('brand_id')->references('id')->on('brands');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products')->cascade();
    }
}
