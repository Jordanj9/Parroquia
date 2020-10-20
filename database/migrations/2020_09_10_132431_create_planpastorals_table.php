<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanpastoralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('planpastorals', function (Blueprint $table) {
            $table->id();
            $table->string('archivo');
            $table->string('descripcion')->nullable();
            $table->foreignId('pastoral_id');
            $table->foreign('pastoral_id')->references('id')->on('pastorals')->cascadeOnDelete();
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
        Schema::dropIfExists('planpastorals');
    }
}
