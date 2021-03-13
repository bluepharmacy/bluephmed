<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    //
     //
    public $table = 'history';

     protected $fillable = [
        'product_id',
        'method',
        'data',
    ];

}
