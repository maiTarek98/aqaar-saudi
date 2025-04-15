<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Resources\Json\JsonResource;
class OrderReturnResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'product_id'            => $this->product_id,
            'product_name'          => $this->product?->name,
            'product_image'         => $this->product?->getFirstMediaUrl('products_image','thumb'),
            'order_id'              => $this->order_id,
            'product_price'         => (double)$this->product?->price,
            'qty'                   => (int)$this->qty,
        ];
    }
}
