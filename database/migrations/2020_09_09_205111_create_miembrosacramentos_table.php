<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiembrosacramentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('miembrosacramentos', function (Blueprint $table) {
            $table->id();
            $table->string('lugar');
            $table->foreignId('sacramento_id');
            $table->foreign('sacramento_id')->references('id')->on('sacramentos')->cascadeOnDelete();
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
        Schema::dropIfExists('miembrosacramentos');
    }
}
