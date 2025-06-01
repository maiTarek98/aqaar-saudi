<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class PropertyAccessLink extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function property() {
       return $this->belongsTo(Product::class,'product_id');
    }

    public function source_user()
    {
        return $this->belongsTo('\App\Models\User', 'source_user_id');
    }
    public function children()
    {
        return $this->hasMany(PropertyAccessLink::class, 'parent_id');
    }
    
    public function parent()
    {
        return $this->belongsTo(PropertyAccessLink::class, 'parent_id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }
    public function parentRecursive()
    {
        return $this->parent()->with('parentRecursive');
    }
    
    public function getAllParents()
    {
        $parents = [];
        $current = $this;
    
        while ($current && $current->parent) {
            $current = $current->parent;
            $parents[] = $current;
        }
    
        return collect($parents);
    }
    
    public function getAllChildrenRecursive()
    {
        return $this->children()->with('childrenRecursive')->get()->flatMap(function ($child) {
            return collect([$child])->merge($child->getAllChildrenRecursive());
        });
    }



}