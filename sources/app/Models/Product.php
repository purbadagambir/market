<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function unit_small()
    {
        return $this->hasOne(Unit::class,'unit_id', 'unit_id');
    }

    public function unit_medium()
    {
        return $this->hasOne(Unit::class,'unit_id', 'unit_id_medium');
    }

    public function unit_large()
    {
        return $this->hasOne(Unit::class,'unit_id', 'unit_id_large');
    }

    public function tesJoin($query){
        return $query->leftJoin('units AS user_updated', function ($join) {
            $join->on('user_created.id', '=', 'orders.updated_by');
        });
    }
}
