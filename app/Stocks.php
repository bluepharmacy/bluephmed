<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    //
    public $table = 'stocks';

     protected $fillable = [
        'product_id',
        'available',
        'alert',
    ];
}
