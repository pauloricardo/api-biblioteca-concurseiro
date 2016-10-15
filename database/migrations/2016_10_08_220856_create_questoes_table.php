<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questoes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('concurso_id')->unsigned();;
            $table->integer('disciplina_id')->unsigned();;

            $table->foreign('concurso_id')->references('id')->on('concursos');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');
            $table->mediumText('texto');
            $table->string('tipo');

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
        Schema::drop('questoes');
    }
}
