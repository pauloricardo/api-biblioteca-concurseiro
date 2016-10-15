<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConcursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concursos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('orgao_id')->unsigned();
            $table->integer('banca_id')->unsigned();

            $table->string('ano');
            $table->timestamps();
        });

        Schema::table('concursos', function (Blueprint $table){
            $table->foreign('orgao_id')->references('id')->on('orgaos');
            $table->foreign('banca_id')->references('id')->on('bancas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('concursos');
    }
}
