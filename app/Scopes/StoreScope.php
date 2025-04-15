<?php
 
namespace App\Scopes;
 
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use App\Models\Store;
class StoreScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {  
         if(auth('admin')->check() && auth('admin')->user()->account_type =='vendors'){
            $builder->where('user_id',auth('admin')->user()->id);

        }
    }
}