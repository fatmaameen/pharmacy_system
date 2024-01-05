<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NigthProduct extends Model
{
    use HasFactory;
    protected $searchable = ['name'];

    protected $table='nigth_products';
    protected $fillable=[
        'name',
        'description',
        'nigth_catg_id',
        'nigth_subcatg',
        'nigth_subsubcatg',
        'total_stock',


    ];
    public function nigth_stock()
    {
        return $this->hasMany(NigthStock_table::class);
    }

}
