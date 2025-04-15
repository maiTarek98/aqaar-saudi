<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource
{
    public function toArray($request)
    {
        return[
            'id'            => $this->id,
            'amount'        => (double) $this->amount,
            'type'          => $this->type,
            'description'   => $this->description,
            'order_id'      => (int) $this->order_id,
            'created_at'    => $this->created_at,

        ];
    }
}
