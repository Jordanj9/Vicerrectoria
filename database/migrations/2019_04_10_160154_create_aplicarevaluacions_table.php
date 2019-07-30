<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAplicarevaluacionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('aplicarevaluacions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('unidadacademica')->nullable();
            $table->string('materia_codigomateria', 30)->nullable();
            $table->string('docente_pegea', 30)->nullable();
            $table->string('docente_pegeq', 30)->nullable();
            $table->bigInteger('personanaturala')->nullable();
            $table->bigInteger('personanaturalq')->nullable();
            $table->bigInteger('periodoacademico_id')->unsigned();
            $table->foreign('periodoacademico_id')->references('id')->on('periodoacademicos')->onDelete('cascade');
            $table->integer('evaluacionaah_id')->unsigned();
            $table->foreign('evaluacionaah_id')->references('id')->on('evaluacionaahs')->onDelete('cascade');
            $table->bigInteger('jefedepartamento_id')->unsigned()->nullable();
            $table->foreign('jefedepartamento_id')->references('id')->on('jefedepartamentos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('aplicarevaluacions');
    }

}
