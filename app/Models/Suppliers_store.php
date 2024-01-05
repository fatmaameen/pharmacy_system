<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Suppliers_store extends Model
{
    use HasFactory;
    protected $table='suppliers';
    protected $fillable=[
        'name',
        'logo',

    ];
    public function phones()
    {
        return $this->hasMany(Suppliers_Phones_store::class);
    }
    public function address(){
        return $this->belongsTo(Suppliers_Address_store::class,'supplier_id');
    }

}
