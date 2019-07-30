<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('personas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipopersona', 2);
            $table->string('direccion', 100)->nullable();
            $table->string('mail',100)->nullable();
            $table->string('celular',20)->nullable();
            $table->string('telefono',50)->nullable();
            $table->string('direccion2',100)->nullable();
            $table->string('telefono2',50)->nullable();
            $table->string('numero_documento',15);
            $table->string('lugar_expedicion',50)->nullable();
            $table->date('fecha_expedicion')->nullable();
            $table->integer('tipodoc_id')->unsigned();
            $table->foreign('tipodoc_id')->references('id')->on('tipodocs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('personas');
    }

}
