<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locate extends Model
{
    //
    public $table = 'locate';

     protected $fillable = [
        'target',
        'map_id',
        'tr',
        'td',
    ];
}

