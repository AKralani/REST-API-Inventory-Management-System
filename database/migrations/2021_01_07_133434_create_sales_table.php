<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            /* $table->increments('id');
            $table->string('description');
            $table->timestamps(); */
            $table->bigIncrements('id');
            $table->string('description');
            //$table->unsignedBigInteger('id_stock');
            //$table->unsignedBigInteger('id_quantity');
            $table->unsignedBigInteger('product_id');
            //$table->unsignedBigInteger('user_id');
            //$table->unsignedBigInteger('client_id');
            //$table->decimal('total_amount', 10, 2)->nullable();
            $table->integer('total_amount')->nullable();
            $table->integer('total_amount_correct')->nullable();
            $table->unsignedDecimal('price', 10, 2);
            $table->unsignedDecimal('total_price', 10, 2);
            $table->timestamp('finalized_at')->nullable();
            //$table->foreign('id_stock')->references('id')->on('stocks');
            //$table->foreign('id_quantity')->references('id')->on('stocks');
            //$table->foreign('user_id')->references('id')->on('users');
            //$table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('product_id')->references('id')->on('products');
            $table->timestamps();
        });

        //product_sale
        Schema::create('product_sale', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('sale_id');
            $table->timestamps();

            $table->unique(['product_id', 'sale_id']);
            
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_sale');
        Schema::dropIfExists('sales');
    }
}
