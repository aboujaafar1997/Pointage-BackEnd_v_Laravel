<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivProfil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('priv_profil', function (Blueprint $table) {
            $table->integer('profil_id')->unsigned();
            $table->foreign('profil_id')->references('id')->on('profils');

            $table->integer('priv_id')->unsigned();
            $table->foreign('priv_id')->references('id')->on('privs');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('priv_profil');
    }
}
