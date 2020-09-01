<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComunidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('comunidads', function (Blueprint $table) {
            $table->id();
            $table->integer('numero');
            $table->enum('dia', ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO', 'DOMINGO']);
            $table->string('hora');
            $table->string('sala')->nullable();
            $table->foreignId('subpastoral_id')->nullable();
            $table->foreign('subpastoral_id')->references('id')->on('subpastorals')->cascadeOnDelete();
            $table->foreignId('pastoral_id')->nullable();
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
        Schema::dropIfExists('comunidads');
    }
}
