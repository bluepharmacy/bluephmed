<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    //
    public $table = 'transactions';

		     protected $fillable = [
		        'customer_id',
		        'customer_name',
		        'payment',
		        'shipping',
		        'discount_less',
		        'grand_total',
		        'customer_money',
		        'change',
		        'staff_id_counter',
		        'staff_id_cashier',
		        'pending_sales_id',
		    ];

}
