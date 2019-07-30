<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignarparsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('asignarpars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('docentea', 30);
            $table->string('docenteacademico_pege', 30);
            $table->foreign('docenteacademico_pege')->references('pege')->on('docenteacademicos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('asignarpars');
    }

}
