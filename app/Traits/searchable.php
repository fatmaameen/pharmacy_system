<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;


trait Searchable
{
    public function scopeSearch(Builder $builder , string $term =''){
        if(!$this->searchable){
            throw new Exception('Please Define This Searchable Property .');
        }
        foreach( $this->searchable as $searchable){
            if(str_contains($searchable,'.')){
                $relation = Str::beforeLast($searchable, '.');
                $column = Str::afterLast($searchable, '.');
                $builder->orWhereRelation($relation, $column, 'like', '%' . $term . '%');
                continue;
            }
            $builder->orwhere($searchable,'like',"%$term%");
        }
        return $builder;
    }
}



?>
