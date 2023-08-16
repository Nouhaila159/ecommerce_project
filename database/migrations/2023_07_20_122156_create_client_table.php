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
        Schema::create('client', function (Blueprint $table) {
            $table->increments('idC');
            $table->string('nomC', 100);
            $table->string('prenomC', 100);
            $table->unsignedBigInteger('telC')->unsigned()->nullable();
            $table->string('adresseC', 500);
            $table->string('villeC', 100);
            $table->string('emailC', 100);
            
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
        Schema::dropIfExists('client');
    }
};
