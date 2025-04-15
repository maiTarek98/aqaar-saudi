<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\User\UserAddressResource;
use App\Http\Resources\Api\User\OrderReturnResource;
class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
     
      protected $orders_count;

   
    public function getOrdersCount($orders_count)
    {
        $this->orders_count = $orders_count;
        return $this;
    }
    
    public function toArray($request)
    {
        return [
            'id'                        => $this->id,
            'order_no'                  => $this->order_no,
            'user_id'                   => $this->user_id,
            'user_name'                 => $this->user?->name,
            'user_mobile'               => $this->user?->mobile,
            'user_balance'              => (double) $this->user?->balance,

            'store_id'                   => $this->store_id,
            'store_name'                 => $this->store?->name,

            'status'                    => $this->status,
            'reason'                    => $this->reason,
            'order_returns'             => OrderReturnResource::collection($this->order_returns),
            'payment_type'              => $this->payment_type,
            'total_item_price'          => (double) $this->total,
            'coupon_id'                 => (int) $this->coupon_id,
            'coupon_code'               => $this->coupon?->coupon_code,
            'user_address_id'           => $this->user_address_id,
            'user_address_data'         => new UserAddressResource($this->user_address),
            'items'                     => CartResource::collection($this->carts),
            'created_at'                => $this->created_at,
            'orders_count'              => $this->carts()->count(),
            // 'has_rated_before'          => $this->rated_before(),
            'grand_total'               => $this->grand_total,
            'applied_coupon'            => $this->applied_coupon,
            'support_info_mobile'       => null,
            'support_info_email'        => null,
        ];
    }
}
