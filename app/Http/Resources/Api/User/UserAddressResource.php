<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Resources\Json\JsonResource;
class UserAddressResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'type'              => $this->type,
            'mark'              => $this->mark,
            'label_name'        => $this->label_name,
            'street_name'       => $this->street_name,
            'apartment_no'      => $this->apartment_no,
            'floor_no'          => $this->floor_no,
            'governorate_id'    => (int)$this->location?->parent?->parent?->id,
            'governorate_name'  => $this->location?->parent?->parent?->name,
            'city_id'           => (int)$this->location?->parent?->id,
            'city_name'         => $this->location?->parent?->name,
            'district_id'       => (int)$this->district_id,
            'district_name'     => $this->location?->name,
            'user_id'           => $this->user_id,
            'created_at'        => $this->created_at->format('Y-m-d H:i:s'),            
        ];
    }
}
