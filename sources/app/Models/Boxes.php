<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boxes extends Model
{
    protected $table ="boxes";
    protected $guarded = ['box_id'];
    public $timestamps = false;
}
