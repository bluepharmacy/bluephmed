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
            $table->id();
            $table->string('name')->unique();
            $table->decimal('unit_price')->default(0);
            $table->decimal('sell_price')->default(0);
            $table->integer('unit_id'); //id of unit
            $table->integer('sold_from')->nullable(); //id of supplier - -
            $table->integer('classification_id')->nullable(); //id of classification ex: Antigout etc - -
            $table->integer('locate_id')->nullable(); //id of locate  -
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
