<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public $table = 'products';

     protected $fillable = [
        'name',
        'unit_id',
        'sold_from',
        'classification_id',
        'locate_id',
    ];
}
