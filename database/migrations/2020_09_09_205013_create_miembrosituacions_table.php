<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiembrosituacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('miembrosituacions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('situacionespiritual_id');
            $table->foreign('situacionespiritual_id')->references('id')->on('situacionespirituals')->cascadeOnDelete();
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
        Schema::dropIfExists('miembrosituacions');
    }
}
