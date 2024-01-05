<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    use HasFactory;
    protected $table='subsubcategories_store';
    protected $fillable=[
        'name',
        'leader',
        'phone_subsubcatg',
        'email',
        'number_employee',
        'status',
        'subcategory_id',
    ];
    public function subcategory(){
        return $this->belongsTo(SubCategories_Store::class,'subcategory_id');
    }


}
