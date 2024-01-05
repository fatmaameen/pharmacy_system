<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NigthCatg extends Model
{
    use HasFactory;
    protected $table='nigth_category';
    protected $fillable=[
        'name',
        'leader',
        'phone_catg',
        'email',
        'number_employee',

    ];


    public function subcatg()
    {
        return $this->hasMany(NigthSubCatg::class);
    }
}
