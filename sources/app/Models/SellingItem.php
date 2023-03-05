<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellingItem extends Model
{
    protected $table="selling_item";
    protected $guarded = ['id'];
    public $timestamps = false;
}
