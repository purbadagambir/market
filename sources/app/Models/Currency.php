<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table ="currency";
    protected $guarded = ['curency_id'];
    public $timestamps = false;
}
