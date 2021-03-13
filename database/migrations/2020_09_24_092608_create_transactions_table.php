<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id')->nullable(); //if not registered = null / seniour id if needed
            $table->string('customer_name')->nullable(); //if not registered = null / seniour id if needed
            $table->string('payment'); //cash,credit card,blueph points
            $table->decimal('shipping')->nullable(); 
            $table->decimal('discount_less')->nullable(); 
            $table->decimal('grand_total'); 
            $table->decimal('customer_money');
            $table->decimal('change');
            $table->integer('staff_id_counter'); //staff id counter  incharge
            $table->integer('staff_id_cashier'); //staff id cashier incharge
            $table->integer('pending_sales_id'); //from pending_sale id

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
        Schema::dropIfExists('transactions');
    }
}
