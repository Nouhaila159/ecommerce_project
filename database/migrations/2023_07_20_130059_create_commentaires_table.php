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
            $table->unsignedBigInteger('id')->nullable();
            $table->integer('idP')->unsigned();
            $table->string('commentaire', 500);
            $table->boolean('statut')->default(false);
            $table->timestamps();

            $table->foreign('id')->references('id')->on('users');
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
