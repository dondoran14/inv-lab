<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_tipo_activo extends Model
{
    use HasFactory;
    protected $table = 'tbl_tipo_activos';
    protected $fillable = ['descripcion'];
}
