<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellingPrice extends Model
{
    protected $table="selling_price";
    protected $guarded = ['price_id'];
    public $timestamps = false;
}
