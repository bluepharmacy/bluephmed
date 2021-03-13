<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    //
     public $table = 'map';

     protected $fillable = [
        'name',
        'table',
    ];
}

