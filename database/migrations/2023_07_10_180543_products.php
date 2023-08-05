<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
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
            $table->string('watershop_id');
            $table->string('product_name');
            $table->string('stock_qty');
            $table->string('item_size');
            $table->string('item_size1');
            $table->string('item_size2');
            $table->string('item_size3');
            $table->string('new');
            $table->string('refill');
            $table->string('price');
            $table->string('photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
