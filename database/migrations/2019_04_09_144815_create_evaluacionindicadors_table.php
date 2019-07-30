<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluacionindicadorsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('evaluacionindicadors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('evaluacionaah_id')->unsigned();
            $table->foreign('evaluacionaah_id')->references('id')->on('evaluacionaahs')->onDelete('cascade');
            $table->integer('indicador_id')->unsigned();
            $table->foreign('indicador_id')->references('id')->on('indicadors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('evaluacionindicadors');
    }

}
