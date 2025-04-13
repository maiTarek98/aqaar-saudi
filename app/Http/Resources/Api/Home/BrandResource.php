<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;
class BrandResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'title'                 => $this->title,
            'in_home'               => $this->in_home,
            'brand_image'           =>$this->getFirstMediaUrl('brands_image','thumb'),
            'created_at'            => $this->created_at,
        ];
    }
}
