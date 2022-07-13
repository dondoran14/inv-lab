<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEstadoToTblInventarioEncabezados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_inventario_encabezados', function (Blueprint $table) {
            $table->json('estado')
                  ->after('descripcion')
                  ->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_inventario_encabezados', function (Blueprint $table) {
            //
        });
    }
}
