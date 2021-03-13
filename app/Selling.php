<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Selling extends Model
{
    //
    public $table = 'selling';

     protected $fillable = [
        'product_id',
        'price',
    ];
}
