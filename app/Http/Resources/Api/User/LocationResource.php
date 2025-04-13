<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Resources\Json\JsonResource;
class LocationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'type'              => $this->type,
            'parent_id'         => (int)$this->parent_id,
            'created_at'        => $this->created_at->format('Y-m-d H:i:s'),     
        ];
    }
}
