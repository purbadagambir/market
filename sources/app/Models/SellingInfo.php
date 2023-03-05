<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellingInfo extends Model
{
    protected $table="selling_info";
    protected $guarded = ['info_id'];
    public $timestamps = false;
}
