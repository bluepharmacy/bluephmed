<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locate', function (Blueprint $table) {
            $table->id();
            $table->string('target')->unique(); //ex: target = map_id.'|'.tr.'|'.td 
            $table->integer('map_id');
            $table->integer('tr');
            $table->integer('td');
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
        Schema::dropIfExists('locate');
    }
}
