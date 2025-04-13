<?php
 
namespace App\Scopes;
 
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use App\Models\Product;
class ProductScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {  
         if(auth('admin')->check() && auth('admin')->user()->account_type !='admins' && ! auth('api')->check()){
            $builder->where('added_by',auth('admin')->user()->id)->orWhere('store_id', auth('admin')->user()->store?->id);
        }
    }
}