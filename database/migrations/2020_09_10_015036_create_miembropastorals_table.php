<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiembropastoralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('miembropastorals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pastoral_id');
            $table->foreign('pastoral_id')->references('id')->on('pastorals')->cascadeOnDelete();
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
        Schema::dropIfExists('miembropastorals');
    }
}
