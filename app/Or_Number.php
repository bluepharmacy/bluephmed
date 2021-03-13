<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Or_Number extends Model
{
    //
    public $table = 'or_number';

     protected $fillable = [
        'order_receipt_number',
        'unit_amount_total',
    ];
}
