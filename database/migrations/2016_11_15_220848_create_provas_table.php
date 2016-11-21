<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('concurso_id')->unsigned();
            $table->integer('cargo_id')->unsigned();

            $table->foreign('concurso_id')->references('id')->on('concursos');
            $table->foreign('cargo_id')->references('id')->on('cargos');
            $table->string('nome');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('provas');
    }
}
