<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    //
     public $table = 'classification';

     protected $fillable = [
        'name',
    ];
}
