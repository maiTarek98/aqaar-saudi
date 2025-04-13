<?php

namespace App\Http\Traits;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

trait VendorStoreTrait
{
    public function getCategories()
    {
        $query = Category::query();
        if(request('in_home')){
            $query = $query->where('in_home',request('in_home'));
        }
        return $query->where('status','show')->whereNull('parent_id')->orderBy('order','asc')->get();
    }

    public function getBrandes()
    {
        $query = Brand::query();
        if(request('in_home')){
            $query = $query->where('in_home',request('in_home'));
        }
        return $query->where('status','show')->get();
    }

    public function getProducts()
    {
        $query = Product::query();
        if(request('in_home')){
            $query = $query->where('is_in_home',request('in_home'));
        }
        if(request('brand_id')){
            $query = $query->where('brand_id',request('brand_id'));
        }
        if(request('category_id')){
            $query = $query->where('category_id',request('category_id'));
        }
        if (request('min_price')) {
        $query->where('price', '>=', request('min_price'));
        }
        if (request('max_price')) {
            $query->where('price', '<=', request('max_price'));
        }
        if (request('min_rate') && request('max_rate')) {
            $minRate = max(0, request('min_rate'));
            $maxRate = min(5, request('max_rate')); 
            $query->whereBetween('avg_rate', [$minRate, $maxRate]);
        }
        if (request('home_sales') && request('home_sales') == 'yes') {
            $query->whereHas('carts', function ($q) {
                $q->where('created_at', '>=', now()->subWeek()) 
                  ->whereHas('order', function ($o) {
                      $o->where('status', 'completed');
                  });
            });
        }
        return $query->where('status','show')->latest()->paginate(6);
    }

    public function getProduct($id)
    {        
        $Product = Product::where('status','show')->where('id',$id)->first();
        if(! $Product){
            return false;
        }
        return $Product;
    }
}
