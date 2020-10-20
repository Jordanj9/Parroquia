<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiembrocomunidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('miembrocomunidads', function (Blueprint $table) {
            $table->id();
            $table->string('categoria')->nullable();
            $table->string('aporte_para')->nullable();
            $table->integer('aporte_mensual')->nullable();
            $table->year('anio_ingreso')->nullable();
            $table->date('fecha_censo_salud')->nullable();
            $table->string('estado')->default('ACTIVO');
            $table->foreignId('comunidad_id');
            $table->foreign('comunidad_id')->references('id')->on('comunidads')->cascadeOnDelete();
            $table->foreignId('miembro_id');
            $table->foreign('miembro_id')->references('id')->on('miembros')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('miembrocomunidads');
    }
}
