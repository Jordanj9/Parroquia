<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComunidadlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('comunidadliders', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 30);
            $table->foreignId('comunidad_id');
            $table->foreign('comunidad_id')->references('id')->on('comunidads')->cascadeOnDelete();
            $table->foreignId('lider_id');
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
        Schema::dropIfExists('comunidadliders');
    }
}
