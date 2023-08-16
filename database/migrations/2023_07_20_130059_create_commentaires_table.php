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
        Schema::create('commentaire', function (Blueprint $table) {
            $table->increments('idCommentaire');
            $table->integer('idC')->unsigned();
            $table->integer('idP')->unsigned();
            $table->string('commentaire', 500);
            $table->integer('note');
            $table->timestamps();

            $table->foreign('idC')->references('idC')->on('client');
            $table->foreign('idP')->references('idP')->on('produit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commentaires');
    }
};
