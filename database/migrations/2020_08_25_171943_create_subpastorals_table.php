<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubpastoralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('subpastorals', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->string('descripcion')->nullable();
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
        Schema::dropIfExists('subpastorals');
    }
}
