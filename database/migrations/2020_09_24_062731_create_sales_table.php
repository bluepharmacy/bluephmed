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
            $table->id();
            $table->integer('transaction_id'); //from transaction id
            $table->integer('product_id');
            $table->integer('quantity');
            $table->integer('discounted'); //1 or 0
            $table->integer('discount_rate')->nullable(); //20 or 32 only
            $table->decimal('price_per_unit'); 
            $table->decimal('total_price');
            $table->decimal('original_total_price'); //if no discount
            $table->longText('discount_less_note')->nullable(); //notes only of what item less and their reasons
            
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
        Schema::dropIfExists('sales');
    }
}
