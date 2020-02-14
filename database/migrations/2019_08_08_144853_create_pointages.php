<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('pointages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_taxi')->unsigned();
            //$table->foreign('id_taxi')->references('id')->on('taxis');
            $table->integer('id_permis')->unsigned();
            //$table->foreign('id_permis')->references('id')->on('permis');
            $table->integer('id_session')->unsigned();
            //$table->foreign('id_session')->references('id')->on('sessions');
            $table->string('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pointages');
    }
}
