<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Latesubcatg extends Model
{
    use HasFactory;
    protected $table='late_subcategory';
    protected $fillable=[
        'name',
        'leader',
        'phone_subcatg',
        'email',
        'number_employee',

        'category_id',
    ];
    public function category(){
        return $this->belongsTo(LateCategory::class,'category_id');
    }
    public function subsubcatg()
    {
        return $this->hasMany(Latesubsub::class);
    }
}
