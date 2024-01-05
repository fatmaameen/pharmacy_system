<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Latesubsub extends Model
{
    use HasFactory;
    protected $table='late_subsubcategory';
    protected $fillable=[
        'name',
        'leader',
        'phone_subsubcatg',
        'email',
        'number_employee',

        'subcategory_id',
    ];
    public function subcategory(){
        return $this->belongsTo(Latesubcatg::class,'subcategory_id');
    }

}
