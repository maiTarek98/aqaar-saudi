<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;
class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                            => $this->id,
            'name'                          => $this->name,
            'category_id'                   => (int) $this->category_id,
            'category_name'                 => $this->category?->title,
            'brand_id'                      => (int) $this->brand_id,
            'brand_name'                    => $this->brand?->title,
            'store_id'                      => (int) $this->store_id,
            'store_name'                    => $this->store?->name,
            'store_orders_return_period'    => $this->store?->orders_return_period,
            'store_image'                   => $this->store?->getFirstMediaUrl('stores_image','thumb'),
            'stock'                         => $this->stock,
            'price'                         => (double) $this->price,
            'discount'                      => (double) $this->discount,
            'discount_type'                 => $this->discount_type,
            'description'                   => $this->description,
            'overview'                      => $this->overview,
            'new_arrival'                   => $this->new_arrival,
            'we_choose_for_u'               => $this->we_choose_for_u,
            'avg_rate'                      => $this->avg_rate,
            'product_image'                 => $this->getFirstMediaUrl('products_image','thumb'),
            'imgaes'                        => ImageResource::collection($this->getMedia('document')),
            'product_reviews'               => ReviewsResource::collection($this->product_reviews->filter(fn($review) => $review->status === 'show')),
            'reviews_count'                 => $this->product_reviews->filter(fn($review) => $review->status === 'show')->count(),
            'is_fav'                        => $this->is_fav(),
            'created_at'                    => $this->created_at,
        ];
    }
}
