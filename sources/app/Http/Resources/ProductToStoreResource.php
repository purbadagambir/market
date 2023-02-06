<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductToStoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'product_id'	    => $this->product_id,
            'store_id'          => $this->store_id,	
            'purchase_price'    => $this->purchase_price,
            'sell_price'	    => $this->sell_price,
            'quantity_in_stock'	=> $this->quantity_in_stock,
            'alert_quantity'    => $this->alert_quantity,
            'sup_id'	        => $this->sup_id,
            'brand_id'	        => $this->brand_id,
            'box_id'	        => $this->box_id,
            'taxrate_id'	    => $this->taxrate_id,
            'tax_method'	    => $this->tax_method,
            'preference'	    => $this->preference,
            'e_date'	        => $this->e_date,
            'p_date'	        => $this->p_date,
            'status'	        => $this->status,
            'sort_order'        => $this->sort_order,
            'product_name'      => $this->product->p_name,
            'product_code'      => $this->product->p_code,
            'unit_small'        => $this->product->unit_small->unit_small_name,
            'unit_small_id'        => $this->product->unit_small->unit_id,
            'unit_medium'       => $this->product->unit_medium->unit_medium_name,
            'unit_medium_id'       => $this->product->unit_medium->unit_id
        ];
    }
}
