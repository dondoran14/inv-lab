<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_perfil extends Model
{
    use HasFactory;
    protected $table = 'tbl_perfils';
    protected $fillable = ['id','nombre_perfil'];
}
