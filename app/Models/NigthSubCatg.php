<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NigthSubCatg extends Model
{
    use HasFactory;
    protected $table='nigth_subcategory';
    protected $fillable=[
        'name',
        'leader',
        'phone_subcatg',
        'email',
        'number_employee',

        'category_id',
    ];
    public function category(){
        return $this->belongsTo(NigthCatg::class,'category_id');
    }
    public function subsubcatg()
    {
        return $this->hasMany(NigthSunsubCatg::class);
    }
}
