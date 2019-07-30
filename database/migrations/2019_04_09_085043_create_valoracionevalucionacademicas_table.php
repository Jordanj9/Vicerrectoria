<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValoracionevalucionacademicasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('valoracionevalucionacademicas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('acronimo', 5);
            $table->string('valor_cualitativo', 50);
            $table->double('valor_cuat1', 4, 2);
            $table->double('valor_cuat2', 4, 2);
            $table->string('descripcion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('valoracionevalucionacademicas');
    }

}
