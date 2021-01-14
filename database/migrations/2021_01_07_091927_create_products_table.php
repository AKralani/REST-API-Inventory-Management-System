<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            /* $table->increments('id');
            $table->string('name');
            $table->string('type');
            $table->timestamps(); */
            $table->bigIncrements('id');
            $table->string('name');
            //$table->string('id_type');
            $table->string('type');
            $table->text('description')->nullable();
            //$table->unsignedBigInteger('product_category_id');
            $table->unsignedDecimal('price', 10, 2);
            //$table->unsignedinteger('stock')->default(0);
            //$table->unsignedinteger('stock_defective')->default(0);
            $table->timestamps();
            //$table->softDeletes();
            //$table->foreign('product_category_id')->references('id')->on('product_categories');
            //$table->foreign('id_type')->references('id')->on('types');
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
