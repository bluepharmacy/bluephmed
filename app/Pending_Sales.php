<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pending_Sales extends Model
{
    //
     public $table = 'pending_sales';

     protected $fillable = [
        'staff_id',
        'sales',
    ];
}
