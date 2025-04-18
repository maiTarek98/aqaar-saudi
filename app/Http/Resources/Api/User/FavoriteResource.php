<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Resources\Json\JsonResource;
use DB;
class FavoriteResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'product_id'            => $this->product_id,
            'product_name'          => $this->product?->name,
            'product_image'         => $this->product?->getFirstMediaUrl('products_image','thumb'),
            'created_at'            => $this->created_at,
        ];
    }
}
