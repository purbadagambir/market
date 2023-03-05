<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellLog extends Model
{
    protected $table="sell_logs";
    protected $guarded = ['id'];
    public $timestamps = false;
}
