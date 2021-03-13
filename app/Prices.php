<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prices extends Model
{
    //
     public $table = 'prices'; //<- this is for UNIT PRICE

     protected $fillable = [
        'product_id',
        'unit_price',
    ];
}
