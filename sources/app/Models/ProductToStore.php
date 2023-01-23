<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductToStore extends Model
{
    protected $table ="product_to_store";

    public function product()
    {
        return $this->hasOne(Product::class,'p_id', 'product_id');
    }
}
