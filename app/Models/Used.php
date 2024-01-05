<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Used extends Model
{
    use HasFactory;
    protected $fillable=['user_id' ,'product_id' ,'used_product'];
    protected $table='used';

    public function product(){
        return $this->belongsTo(Products::class);
    }

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
