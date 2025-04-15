<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Product;

class AuthResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'name'                  => $this->name,
            'email'                 => $this->email,
            'mobile'                => $this->mobile,
            'mobile_verified_at'    => $this->mobile_verified_at,
            'photo_profile'         => $this->getFirstMediaUrl('photo_profile','thumb'),
            'balance'               => (double) $this->balance,
            'status'                => $this->status,
            'min_products_value'    => ceil(Product::get()->min('real_price')),
            'max_products_value'    => ceil(Product::get()->max('real_price')),
            'created_at'            => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
