<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->dateTime('fecha');
            $table->string('lugar')->nullable();
            $table->string('responsable')->nullable();
            $table->foreignId('administracion_id');
            $table->foreign('administracion_id')->references('id')->on('administracions')->cascadeOnDelete();
            $table->foreignId('pastoral_id');
            $table->foreign('pastoral_id')->references('id')->on('pastorals')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('eventos');
    }
}
