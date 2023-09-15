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
        Schema::create('info_site', function (Blueprint $table) {
            $table->increments('idS');
            $table->string('nomS', 255)->nullable();
            $table->string('titreS', 255)->nullable();
            $table->string('urlPhotoS', 255)->nullable();
            $table->string('descriptionS', 255)->nullable();
            $table->string('emailS', 50)->nullable();
            $table->string('adesseS', 255)->nullable();
            $table->unsignedBigInteger('teleS')->unsigned()->nullable();
            $table->string('footerS', 255)->nullable();
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
        Schema::dropIfExists('info_site');
    }
};
