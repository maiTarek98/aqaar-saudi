<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'url'                   => url('/storage/products_images/'.$this->id.'/'.$this->file_name),
            'created_at'            => $this->created_at,
        ];
    }
}
