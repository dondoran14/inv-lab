<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblInventarioDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_inventario_detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_inventario')->unsigned();
            $table->foreign('id_inventario')->references('id')->on('tbl_inventario_encabezados')
            ->onDelete('cascade');
            $table->integer('objeto_gasto')->defaul(0);
            $table->float('valor_adquirido')->defaul(0);
            $table->float('valor_residual')->defaul(0);
            $table->integer('vida_util')->defaul(0);
            $table->float('depreciacion_anual')->defaul(0);
            $table->float('depreciacion_mensual')->defaul(0);
            $table->float('depreciacion_acumulada')->defaul(0);
            $table->float('valor_libros')->defaul(0);
            $table->float('valor_desecho')->defaul(0);
            $table->date('fecha_compra');
            $table->date('fecha_desecho');
            $table->string('nombre_activo',75)->nullable();
            $table->text('descripcion')->nullable();
            $table->string('ubicacion',75)->nullable();
            $table->string('encargado',75)->nullable();
            $table->string('region',75)->nullable();
            $table->integer('tipo_activo')->unsigned();
            $table->foreign('tipo_activo')->references('id')->on('tbl_tipo_activos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_inventario_detalles');
    }
}
