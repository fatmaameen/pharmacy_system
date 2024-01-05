<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LateCategory extends Model
{
    use HasFactory;
    protected $table='late_category';
    protected $fillable=[
        'name',
        'leader',
        'phone_catg',
        'email',
        'number_employee',

    ];


    public function subcatg()
    {
        return $this->hasMany(Latesubcatg::class);
    }
}
