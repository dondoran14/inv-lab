<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_laboratorio extends Model
{
    use HasFactory;
    protected $table = 'tbl_laboratorios';
    protected $fillable = ['id','nombre_laboratorio'];
}
