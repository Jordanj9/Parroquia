<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiembrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('miembros', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_documento', 15);
            $table->string('identificacion', 20);
            $table->string('nombres', 80);
            $table->string('apellidos', 80);
            $table->enum('sexo', ['MASCULINO', 'FEMENINO', 'OTRO']);
            $table->date('fechanacimiento')->nullable();
            $table->date('edad')->nullable();
            $table->string('nombre_conyugue', 150)->nullable();
            $table->integer('numero_hijos')->nullable();
            $table->string('nombre_padres')->nullable();
            $table->date('fecha_anulacion_matrimonio')->nullable();
            $table->string('representante')->nullable();
            $table->string('colegio')->nullable();
            $table->integer('grado')->nullable();
            $table->integer('num_hermanos')->nullable();
            $table->string('vivecon')->nullable();
            $table->string('direccion', 100)->nullable();
            $table->string('barrio', 80)->nullable();
            $table->integer('telefono')->nullable();
            $table->bigInteger('celular')->nullable();
            $table->enum('trabaja', ['SI', 'NO'])->default('NO');
            $table->string('empresa')->nullable();
            $table->string('habitacion')->nullable();
            $table->enum('conquienvive', ['FAMILIA', 'AMIGOS', 'SOLO'])->nullable();
            $table->enum('entorno_material', ['DE MATERIAL', 'BARRO', 'NO TIENE CASA'])->nullable();
            $table->enum('acueducto', ['SI', 'NO'])->nullable();
            $table->enum('alcantarillado', ['SI', 'NO'])->nullable();
            $table->enum('luz', ['SI', 'NO'])->nullable();
            $table->enum('tel', ['SI', 'NO'])->nullable();
            $table->enum('sanitario', ['SI', 'NO'])->nullable();
            $table->enum('letrina', ['SI', 'NO'])->nullable();
            $table->enum('gas', ['SI', 'NO'])->nullable();
            $table->string('no_hay')->nullable();
            $table->text('antecedentes')->nullable();
            $table->string('estado_animico', 50)->nullable();
            $table->foreignId('estadocivil_id')->nullable();
            $table->foreign('estadocivil_id')->references('id')->on('estadocivils')->cascadeOnDelete();
            $table->foreignId('ocupacion_id')->nullable();
            $table->foreign('ocupacion_id')->references('id')->on('ocupacions')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('miembros');
    }
}
