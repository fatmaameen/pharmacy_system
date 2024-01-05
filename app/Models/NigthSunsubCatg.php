<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NigthSunsubCatg extends Model
{
    use HasFactory;
    protected $table='nigth_subsubcategory';
    protected $fillable=[
        'name',
        'leader',
        'phone_subsubcatg',
        'email',
        'number_employee',

        'subcategory_id',
    ];
    public function subcategory(){
        return $this->belongsTo(NigthSubCatg::class,'subcategory_id');
    }

}
