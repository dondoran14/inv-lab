<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_inventario_encabezado extends Model
{
    use HasFactory;
    protected $table = 'tbl_inventario_encabezados';
    protected $dates = [
        'startOfTime',
        'endOfTime',
        'created_at',
        'updated_at'
    ];
    protected $casts = ['created_at' => 'date:Y-m-d'];
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = ['id_laboratorio','gestion','numero_inventario','numero_ficha','descripcion','estado','created_at'];
}
