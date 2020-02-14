<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permis', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_del');
            $table->date('date_exp');
            $table->integer('n_tage');
            $table->string('is_valide');
            $table->string('id_chauffeur');
           //$table->foreign('id_chauffeur')->references('id')->on('chauffeurs');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permis');
    }
}
