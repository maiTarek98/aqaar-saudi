<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'status'                => $this->status,
            'created_at'            => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
