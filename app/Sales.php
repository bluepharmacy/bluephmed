<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    //
            public $table = 'sales';

		     protected $fillable = [
		        'transaction_id',
		        'product_id',
		        'quantity',
		        'discounted',
		        'discount_rate',
		        'price_per_unit',
		        'total_price',
		        'original_total_price',
		        'discount_less_note',
		    ];
}
