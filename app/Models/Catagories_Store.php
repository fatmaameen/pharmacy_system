<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Catagories_Store extends Model
{
    use HasFactory;

    protected $table='categories';
    protected $fillable=[
        'name',
        'leader',
        'phone_catg',
        'email',
        'number_employee',
        'status'
    ];


    public function subcatg()
    {
        return $this->hasMany(SubCategories_Store::class);
    }
}
