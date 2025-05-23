<?php
 
namespace App\Scopes;
 
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
 
class UserScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {  
         if(auth('admin')->check() && (auth('admin')->user()->hasRole('vendors')  || auth('admin')->user()->hasRole('admins'))){
            $builder->where('user_id',auth('admin')->user()->id);
           
        }
    }
}