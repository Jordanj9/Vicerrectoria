<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('cargos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion', 250);
            $table->string('codigo',10)->nullable();
            $table->string('nombre', 80)->nullable();
            $table->string('tipo', 2)->nullable();
            $table->integer('numero_empleados')->nullable();
            $table->string('tiene_funcion', 2)->nullable()->default('1');
            $table->string('labordocente',2)->nullable()->default('0');
            $table->string('representacion',2)->nullable()->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('cargos');
    }

}
