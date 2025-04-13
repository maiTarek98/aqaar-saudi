<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Gate;
class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'title'                 => $this->title,
            'in_home'               => $this->in_home,
            'created_at'            => $this->created_at,
        ];
    }
}
