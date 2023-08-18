<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_commande', function (Blueprint $table) {
            $table->increments('idLigneC');
            $table->integer('idCommande')->unsigned()->nullable();
            $table->integer('idR')->unsigned()->nullable();
            $table->integer('quantite')->nullable();
            $table->integer('idT')->nullable();
            $table->timestamps();

            $table->foreign('idCommande')->references('idCommande')->on('commandes')->onDelete('cascade');
            $table->foreign('idR')->references('idR')->on('reference')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ligne_commande');
    }
};
