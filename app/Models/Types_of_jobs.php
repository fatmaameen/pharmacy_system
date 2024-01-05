<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Types_of_jobs extends Model
{
    use HasFactory;
    protected $table='job_title';
    protected $fillable=['title'];
}
