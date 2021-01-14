<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->integer('quantity');
            //$table->unsignedBigInteger('id_stock');
            $table->integer('id_product');
            //$table->string('price');
            //$table->integer('category_id');
            //$table->string('category_name');
            //$table->float('purchase_cost');
            //$table->float('selling_cost');
            //$table->float('suppler_cost');
            //$table->integer('supplier_id');
            $table->timestamps();
            $table->foreign('id_product')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
