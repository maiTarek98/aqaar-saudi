<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\ResturantResource;
class CouponWheelResource extends JsonResource
{
    public function toArray($request)
    {
        
        
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'price'             => $this->price,
            'start_date'        => $this->start_date,
            'end_date'          => $this->end_date,
            'status'            => $this->status,
            'image'             =>$this->getFirstMediaUrl('coupon_wheel_image','thumb'),
            'resturants'=>CouponWheelResturant::collection($this->resturants),
            
            'created_at'        => $this->created_at,
        ];
    }
}
