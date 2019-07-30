<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupousuariosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('grupousuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('descripcion')->nullable();
            $table->timestamps();
        });
        
        Schema::create('grupousuario_pagina', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('grupousuario_id')->unsigned();
            $table->foreign('grupousuario_id')->references('id')->on('grupousuarios')->onDelete('cascade');
            $table->integer('pagina_id')->unsigned();
            $table->foreign('pagina_id')->references('id')->on('paginas')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('grupousuario_modulo', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('grupousuario_id')->unsigned();
            $table->foreign('grupousuario_id')->references('id')->on('grupousuarios')->onDelete('cascade');
            $table->integer('modulo_id')->unsigned();
            $table->foreign('modulo_id')->references('id')->on('modulos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('grupousuarios');
    }

}
