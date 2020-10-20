<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPadresmaternorToMiembrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('miembros', function (Blueprint $table) {
            $table->string('nombre_padres_maternos')->nullable()->after('nombre_padres');
            $table->renameColumn('nombre_padres', 'nombre_padres_paternos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('miembros', function (Blueprint $table) {
            $table->dropColumn('nombre_padres_maternos');
            $table->renameColumn('nombre_padres_paternos', 'nombre_padres');
        });
    }
}
