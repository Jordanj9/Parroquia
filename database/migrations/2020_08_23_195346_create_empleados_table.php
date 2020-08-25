<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('cargo', 30);
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('estado', 50)->default('ACTIVO');
            $table->string('tipo_documento');
            $table->string('identificacion', 15);
            $table->enum('sexo', ['MASCULINO', 'FEMENINO','OTRO']);
            $table->string('direccion');
            $table->string('barrio')->nullable();
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->string('correo')->nullable();
            $table->foreignId('administracion_id');
            $table->foreign('administracion_id')->references('id')->on('administracions')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('empleados');
    }
}
