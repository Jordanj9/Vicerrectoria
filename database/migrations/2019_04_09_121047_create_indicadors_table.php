<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicadorsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('indicadors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('indicador');
            $table->integer('criterioevaluacion_id')->unsigned();
            $table->foreign('criterioevaluacion_id')->references('id')->on('criterioevaluacions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('indicadors');
    }

}
