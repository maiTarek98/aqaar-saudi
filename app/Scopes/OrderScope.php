<?php
 
namespace App\Scopes;
 
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use App\Models\Order;
class OrderScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {  
        if(auth('admin')->check() && auth('admin')->user()->account_type == 'subadmins'){
            $builder->where('assign_to',auth('admin')->user()->id);
        }elseif(auth('admin')->check() && auth('admin')->user()->account_type == 'vendors'){
            $builder->whereHas('store', function ($query) {
                $query->where('user_id', auth('admin')->user()->id);
            });
        }
    }
}