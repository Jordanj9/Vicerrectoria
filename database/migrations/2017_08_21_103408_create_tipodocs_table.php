<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipodocsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tipodocs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->string('tipo_persona', 2);
            $table->string('abreviatura', 5)->nullable();
            $table->string('tipo', 12)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('tipodocs');
    }

}
