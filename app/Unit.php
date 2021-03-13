<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    public $table = 'unit';

     protected $fillable = [
        'per',
    ];
}
