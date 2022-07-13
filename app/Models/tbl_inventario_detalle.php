<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_inventario_detalle extends Model
{
    use HasFactory;
    protected $table = 'tbl_inventario_detalles';
    protected $dates = [
        'startOfTime',
        'endOfTime',
        'created_at',
        'updated_at'
    ];
    protected $casts = ['created_at' => 'date:Y-m-d'];
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = ['id_inventario','objeto_gasto','valor_adquirido','valor_residual','vida_util','depreciacion_anual','depreciacion_mensual','depreciacion_acumulada','valor_libros','valor_desecho','fecha_compra','fecha_desecho','nombre_activo','descripcion','ubicacion','encargado','region','tipo_activo'];
}
