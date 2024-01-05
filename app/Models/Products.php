<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Ahmetsabri\FatihLaravelSearch\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory,Searchable ;

    protected $searchable = ['name'];

    protected $table='products';
    protected $fillable=[
        'name',
        'description',
        'catg_id',
        'subcatg',
        'subsubcatg',
        'total_stock',
        'alarm'

    ];
    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

}
