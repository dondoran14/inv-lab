<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblInventarioEncabezadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_inventario_encabezados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_laboratorio')->unsigned();
            $table->foreign('id_laboratorio')->references('id')->on('tbl_laboratorios');
            $table->string('gestion',75);
            $table->string('numero_inventario',100);
            $table->string('numero_ficha',75);
            $table->text('descripcion')->nullable();
            $table->string('estado')->default('');
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
        Schema::dropIfExists('tbl_inventario_encabezados');
    }
}
