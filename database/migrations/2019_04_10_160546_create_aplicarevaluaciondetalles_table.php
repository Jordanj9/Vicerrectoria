<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAplicarevaluaciondetallesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('aplicarevaluaciondetalles', function (Blueprint $table) {
            $table->increments('id');
            $table->double('valor', 4, 2);
            $table->integer('aplicarevaluacion_id')->unsigned();
            $table->foreign('aplicarevaluacion_id')->references('id')->on('aplicarevaluacions')->onDelete('cascade');
            $table->integer('evaluacionindicador_id')->unsigned();
            $table->foreign('evaluacionindicador_id')->references('id')->on('evaluacionindicadors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('aplicarevaluaciondetalles');
    }

}
