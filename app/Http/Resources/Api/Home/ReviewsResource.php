<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'review'       => $this->review,
            'star'         => $this->star,
            'user_id'      => $this->user_id,
            'user_name'    => $this->user?->name,
            'user_photo'   => $this->user?->getFirstMediaUrl('photo_profile','thumb'),
            'created_at'   => $this->created_at,
        ];
    }
}
