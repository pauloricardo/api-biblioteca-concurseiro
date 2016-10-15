<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestoesrespostasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questoes_respostas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('questao_id')->unsigned();;
            $table->foreign('questao_id')->references('id')->on('questoes');
            $table->string('enunciado')->references('id')->on('cargos');

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
        Schema::drop('questoes_respostas');
    }
}
