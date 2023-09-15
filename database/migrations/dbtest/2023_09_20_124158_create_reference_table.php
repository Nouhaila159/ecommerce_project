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
        Schema::create('reference', function (Blueprint $table) {
            $table->increments('idR');
            $table->integer('idP')->unsigned()->nullable();
            $table->string('referenceP', 255)->nullable();
            $table->string('couleur', 50)->nullable();
            $table->string('urlPhoto', 255)->nullable();
            $table->integer('quantiteR')->nullable();
            $table->timestamps();

            $table->foreign('idP')->references('idP')->on('produit')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reference');
    }
};
