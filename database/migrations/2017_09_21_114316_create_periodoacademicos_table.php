<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodoacademicosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('periodoacademicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fechainicio');
            $table->date('fechafin');
            $table->string('anio', 4);
            $table->string('periodo', 2)->nullable();
            $table->date('fechainicioclases');
            $table->date('fechafinclases');
            $table->integer('tipo_periodo_id')->unsigned();
            $table->foreign('tipo_periodo_id')->references('id')->on('tipo_periodos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('periodoacademicos');
    }

}
