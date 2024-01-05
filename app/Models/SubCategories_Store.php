<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategories_Store extends Model
{
    use HasFactory;
    protected $table='subcategories_store';
    protected $fillable=[
        'name',
        'leader',
        'phone_subcatg',
        'email',
        'number_employee',
        'status',
        'category_id',
    ];
    public function category(){
        return $this->belongsTo(Catagories_Store::class,'category_id');
    }
    public function subsubcatg()
    {
        return $this->hasMany(SubSubCategory::class);
    }
}
