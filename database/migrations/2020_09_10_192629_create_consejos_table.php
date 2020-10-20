<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsejosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('consejos', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['PASTORAL', 'ECONÓMICO']);
            $table->foreignId('administracion_id');
            $table->foreign('administracion_id')->references('id')->on('administracions')->cascadeOnDelete();
            $table->foreignId('miembro_id')->nullable();
            $table->foreign('miembro_id')->references('id')->on('miembros')->cascadeOnDelete();
            $table->foreignId('lider_id')->nullable();
            $table->foreign('lider_id')->references('id')->on('liders')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('consejos');
    }
}
