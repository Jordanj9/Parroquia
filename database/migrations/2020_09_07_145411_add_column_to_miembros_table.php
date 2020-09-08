<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToMiembrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('miembros', function (Blueprint $table) {
            $table->date('fecha_matrimonio')->nullable()->after('nombre_padres');
            $table->enum('casadopor',['IGLESIA','CIVIL'])->nullable();
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
            $table->dropColumn(['fecha_matrimonio','casadopor']);
        });
    }
}
