<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaniersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paniers', function (Blueprint $table) {
            $table->increments('idPaniers');
            $table->unsignedBigInteger('user_id');
            $table->integer('idP')->unsigned()->nullable();
            $table->integer('idR')->unsigned()->nullable();
            $table->integer('idT')->unsigned()->nullable();
            $table->integer('quantiteP');
            $table->timestamps();
            
            // Définir les clés étrangères
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('idP')->references('idP')->on('produit');
            $table->foreign('idR')->references('idR')->on('reference');
            $table->foreign('idT')->references('idT')->on('tailles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paniers');
    }
}
